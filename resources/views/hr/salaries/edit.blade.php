<h3>Edit Salary</h3>

<form action="{{ route('hr.salaries.update', $salary->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Base Salary</label>
        <input type="number" name="base_salary" class="form-control"
               step="0.01"
               value="{{ old('base_salary', $salary->base_salary) }}"
               required>
        @error('base_salary')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Effective Date</label>
        <input type="date" name="effective_date" class="form-control"
               value="{{ old('effective_date', $salary->effective_date) }}"
               required>
        @error('effective_date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>

    <a href="{{ route('hr.salaries.index', $salary->employee_id) }}" 
       class="btn btn-secondary">Kembali</a>
</form>
