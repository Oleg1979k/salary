<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $attributes = [
        'car' => false,
    ];
    public $timestamps = false;
    protected $fillable= [
        'fio','age','salary'
    ];

    public static function makeModel(Request $request)
    {
        $employee = new self();
        $employee->fio = $request->fio;
        $employee->age = $request->age;
        $employee->salary = $request->salary;
        $employee->count_child = $request->count_child;
        if(!empty($request['car'])) $employee->car = true;
        $employee->to_receive = self::AccrualOfSalary(
            $employee->age,
            $employee->count_child,
            $employee->car,
            $employee->salary);
        $employee->save();
        return $employee;
    }

    public static function AccrualOfSalary($age,$count_child,$car,$salary): float
    {
        $accrual = $salary;
        if ($age > 50) {
            $accrual = $accrual * 1.07;
        }

        if ($count_child > 2) {
            $nalog = 0.18;
        } else {
            $nalog = 0.2;
        }

        if ($car) {
            $accrual = $accrual - 25000;
        }

        $accrual = $accrual - $nalog * $accrual;

        return $accrual;
    }
}
