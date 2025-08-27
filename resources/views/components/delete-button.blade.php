<form id="deleteForm{{ $itemId }}" action="{{ $action }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 ml-2" title="{{ $label }}"
        onclick="confirmDelete(event, '{{ $itemId }}')">
        <i class="fa-solid fa-trash-can"></i>&nbsp;{{ $label }}
    </button>
</form>
