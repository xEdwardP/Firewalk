@props([
    'disabled' => false,
    'title' => 'Eliminar',
])

<form id="deleteForm{{ $itemId }}" action="{{ $action }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger rounded-pill px-4 py-1 ml-2" title="{{ $label }}" @if ($disabled) disabled @endif
        onclick="confirmDelete(event, '{{ $itemId }}')">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>
