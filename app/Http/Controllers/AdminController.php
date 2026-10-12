<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getDashboardData()
    {
        $totalParticipants = DB::table('reaction_logs')->distinct('session_id')->count('session_id');
        $totalAttempts = DB::table('reaction_logs')->count();
        $globalAvgRT = DB::table('reaction_logs')->where('is_correct', true)->avg('reaction_time_ms');
        $totalCorrect = DB::table('reaction_logs')->where('is_correct', true)->count();
        $accuracy = $totalAttempts > 0 ? ($totalCorrect / $totalAttempts) * 100 : 0;

        $chartData = DB::table('reaction_logs')
            ->select('attempt_number', DB::raw('AVG(reaction_time_ms) as avg_rt'))
            ->where('is_correct', true)->groupBy('attempt_number')->orderBy('attempt_number')->get();

        $recentLogs = DB::table('reaction_logs')->orderBy('created_at', 'desc')->limit(20)->get();

        return response()->json([
            'kpis' => [
                'total_participants' => $totalParticipants,
                'total_attempts' => $totalAttempts,
                'global_avg_rt' => round($globalAvgRT, 1),
                'accuracy' => round($accuracy, 1)
            ],
            'chart' => $chartData,
            'logs' => $recentLogs
        ]);
    }

    public function saveResults(Request $request)
    {
        $data = $request->validate([
            'results' => 'required|array',
            'results.*.session_id' => 'required|string',
            'results.*.name' => 'required|string', // <--- TAMBAHKAN BARIS INI
            'results.*.age' => 'required|integer',
            'results.*.attempt_number' => 'required|integer',
            'results.*.reaction_time_ms' => 'required|integer',
            'results.*.is_correct' => 'required|boolean',
            'results.*.device_platform' => 'nullable|string',
        ]);

        $insertData = array_map(function ($row) {
            $row['created_at'] = now();
            $row['updated_at'] = now();
            return $row;
        }, $data['results']);

        DB::table('reaction_logs')->insert($insertData);

        return response()->json(['status' => 'success']);
    }

public function exportCsv()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=focusquest_raw_data.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $logs = DB::table('reaction_logs')->orderBy('id', 'asc')->get();
        // Tambahkan 'Name' ke dalam header CSV
        $columns = ['ID', 'Session ID', 'Name', 'Age', 'Attempt Number', 'Reaction Time (ms)', 'Is Correct', 'Device Platform', 'Timestamp'];

        $callback = function() use($logs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->session_id,
                    $log->name, // Output nama partisipan ke CSV
                    $log->age,
                    $log->attempt_number,
                    $log->reaction_time_ms,
                    $log->is_correct,
                    $log->device_platform,
                    $log->created_at
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function getRawDataAPI()
    {
        $logs = DB::table('reaction_logs')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
            
        return response()->json($logs);
    }
}