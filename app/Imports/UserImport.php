<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UserImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure
{

    use Importable,
        SkipsErrors,
        SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        return new User([
            'UserName' => $row['ma_sv'],
            'Password' => '123',
            'UserRole' => 0,
            'FullName' => $row['ho_va_ten'],
            'Email' => $row['email'],
            'DateOfBirth' => $row['ngay_sinh'],
            'CourseClass' => $row['lop'],
            'CreatedTime' => now(),
            // 'CreatedBy'=>$row[''],
            // 'ModifiedTime'=>$row[''],
            // 'ModifiedBy'=>$row[''],
        ]);
    }


    public function rules(): array
    {
        return [
            '*.ma_sv' => ['unique:user,UserName'],
            '*.email' => ['unique:user,Email'],
        ];
    }
}
