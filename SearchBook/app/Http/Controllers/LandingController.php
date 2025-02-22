<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $rank = $request->input('rank');

        // Perbaikan instansiasi Process
        $process = new Process(["python", "query.py", "output", $rank, $query]);
        
        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            return response()->json(['error' => 'Failed to execute the Python script.'], 500);
        }

        $list_data = array_filter(explode("\n", $process->getOutput()));

        $data = [];

        foreach ($list_data as $book) {
            $dataj = json_decode($book, true);
            $data[] = '
            <div class="col-lg-5">
                <div class="card mb-2">
                    <div style="display: flex; flex: 1 1 auto;">
                        <div class="img-square-wrapper">
                            <img src="http://books.toscrape.com/' . $dataj['image'] . '">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><a target="_blank" href="http://books.toscrape.com/catalogue/' . $dataj['url'] . '">' . $dataj['title'] . '</a></h6>
                            <p class="card-text text-success">Price : ' . $dataj['price'] . '</p>
                        </div>
                    </div>
                </div>
            </div>';
        }

        return response()->json($data);
    }
}
