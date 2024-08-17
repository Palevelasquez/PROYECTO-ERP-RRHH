<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User; // Asegúrate de importar el modelo de User
use App\Models\Notification; // Asegúrate de importar el modelo de Notification
use App\Models\Sale; // Asegúrate de importar el modelo de Sale
use App\Models\Order; // Asegúrate de importar el modelo de Sale
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use App\Models\Department;



class DashboardStatistics extends Component
{
    public $totalUsers;
    public $totalEmployees;
    public $latestEmployeesCount;
    public $employeesByDepartment;
    public $totalNotifications;

    public function mount()
    {
        $this->totalNotifications = Notification::count(); // Asegúrate de que esta línea se ajuste a tu modelo de notificaciones
        // Aquí defines la variable totalUsers
        $this->totalUsers = User::count(); // Suponiendo que tienes un modelo User
        
        $this->totalEmployees = Empleado::count();

        $this->latestEmployeesCount =  Empleado::latest()->take(5)->get(); // Obtén los últimos 5 empleados

        $this->employeesByDepartment = Department::withCount('employees')->get();

    }

    public function render()
    {
        return view('livewire.dashboard-statistics');
    }
}