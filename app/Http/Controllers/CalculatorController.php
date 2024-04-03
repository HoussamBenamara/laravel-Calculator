<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function calculate(CalculatorRequest $request)
    {
        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $operator = $request->input('operator');

        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                $result = $num1 / $num2;
                break;
            default:
                $result = null;
                break;
        }

        if ($result !== null) {
            return response()->json(['result' => $result]);
        } else {
            return response()->json(['error' => 'Please select an operation'], 400);
        }
    }

}
