<form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?')">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
