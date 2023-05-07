<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    SkipsOnFailure,
    WithProgressBar
{

    use Importable,
        SkipsErrors,
        SkipsFailures;


    protected $createdBy;
    protected $password;
    protected $userRole;

    public function __construct($createdBy = 'PĐT', $userType = 0, $password = '123')
    {
        $this->createdBy = $createdBy;
        $this->userRole = $userType;
        $this->password = $password;

        // $this->password=Hash::make($password);
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd(Hash::make('123'));
        return new User([
            'UserName' => $row['ma_sv'],
            'Password' => $this->password,
            'UserRole' => $this->userRole,
            'FullName' => $row['ho_va_ten'],
            'Email' => $row['email'],
            'DateOfBirth' => '2001-01-01',
            'CourseClass' => $row['lop'],
            'CreatedTime' => now(),
            'CreatedBy' => $this->createdBy,
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
