<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements
    FromCollection,
    Responsable,
    ShouldAutoSize,
    WithHeadings,
    WithMapping
{

    use Exportable;

    private $fileName = 'export-users.xlsx';

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd(User::all());
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->UserId,
            $user->UserName,
            $user->FullName,
            $user->UserRole,
            $user->DateOfBirth,
            $user->CourseClass,
            $user->Email,
        ];
    }

    public function headings(): array
    {
        return [
            'UserId',
            'UserName',
            'FullName',
            'UserRole',
            'DateOfBirth',
            'CourseClass',
            'Email',

        ];
    }
}
