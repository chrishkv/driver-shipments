<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentsController extends Controller
{
    public  function index()
    {
        $shipments = [];
        return view('upload', compact('shipments'));
    }

    public function table(Request $request)
    {
        $validated = $request->validate([
            'driversFile' => 'required|file|mimes:txt',
            'adressFile' => 'required|file|mimes:txt',
        ]);

        $driversFile = $request->file('driversFile');
        $adressFile = $request->file('adressFile');
        $drivers = $driversFile->get();
        $adress = $adressFile->get();
        $driversArray = explode("\n", $drivers);
        $adressArray = explode("\n", $adress);
        $points = $this->pointDrivers($driversArray, $adressArray);
        $shipments = $this->assignmentDrivers($points, $adressArray);
        return view('upload', compact('shipments'));
    }

    public function pointDrivers($drivers, $adress)
    {
        $points = [];
        foreach ($adress as $street) {
                foreach ($drivers as $driver) {
                    $vocals = $this->countVocals($driver);
                    if (strlen($street) % 2 == 0) {
                        $point = $vocals * 1.5;
                    } else {
                        $point = $vocals * 1;
                    }
                    if ($this->containsNames($driver, $street)) {
                        $point += $point * 0.5;
                    }
                    $points[$driver][] = $point;
                }
        }
        
        return $points;
    }

    public function countVocals($string)
    {
        $vocals = ['a', 'e', 'i', 'o', 'u'];
        $count = 0;
        foreach ($vocals as $vocal) {
            $count += substr_count($string, $vocal);
        }

        return $count;
    }

    public function containsNames($driver, $street)
    {
        foreach(explode(" ", $driver) as $names) {
            if (strpos($street, $names) !== false) {
                return true;
            }
        }

        return false;
    }

    public function assignmentDrivers($points, $adress)
    {
        $deleted = [];
        $tableResult = [];
        foreach ($points as $key => $value) {
            foreach ($deleted as $del) unset($value[$del]);
            $selected = array_keys($value, max($value))[0];
            $deleted[] = $selected;
            $tableResult[$key] = $adress[$selected];
        }
        
        return $tableResult;
    }
}
