<form method="POST" action="{{ route('hr.payroll-items.update', $item->id) }}" class="bg-white rounded-lg shadow p-6">
    @csrf 
    @method('PUT')
    
    <h3 class="text-lg font-semibold mb-4 text-gray-800">Update Payroll Item</h3>
    
    <!-- Base Salary (Readonly) -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Base Salary</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500">Rp</span>
            </div>
            <input type="text" 
                   value="{{ number_format($item->base_salary, 0, ',', '.') }}"
                   class="pl-12 w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700"
                   readonly>
        </div>
        <p class="text-xs text-gray-500 mt-1">Base salary tidak dapat diubah</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Allowance -->
        <div class="mb-4">
            <label for="allowance" class="block text-sm font-medium text-gray-700 mb-1">
                Allowance <span class="text-gray-400">(Tunjangan)</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500">Rp</span>
                </div>
                <input type="number" 
                       name="allowance" 
                       id="allowance"
                       value="{{ old('allowance', $item->allowance) }}"
                       class="pl-12 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0"
                       min="0"
                       step="1000">
            </div>
            @error('allowance')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Overtime -->
        <div class="mb-4">
            <label for="overtime" class="block text-sm font-medium text-gray-700 mb-1">
                Overtime <span class="text-gray-400">(Lembur)</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500">Rp</span>
                </div>
                <input type="number" 
                       name="overtime" 
                       id="overtime"
                       value="{{ old('overtime', $item->overtime) }}"
                       class="pl-12 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0"
                       min="0"
                       step="1000">
            </div>
            @error('overtime')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Bonus -->
        <div class="mb-4">
            <label for="bonus" class="block text-sm font-medium text-gray-700 mb-1">
                Bonus
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500">Rp</span>
                </div>
                <input type="number" 
                       name="bonus" 
                       id="bonus"
                       value="{{ old('bonus', $item->bonus) }}"
                       class="pl-12 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0"
                       min="0"
                       step="1000">
            </div>
            @error('bonus')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Deduction -->
        <div class="mb-4">
            <label for="deduction" class="block text-sm font-medium text-gray-700 mb-1">
                Deduction <span class="text-gray-400">(Potongan)</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500">Rp</span>
                </div>
                <input type="number" 
                       name="deduction" 
                       id="deduction"
                       value="{{ old('deduction', $item->deduction) }}"
                       class="pl-12 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0"
                       min="0"
                       step="1000">
            </div>
            @error('deduction')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- Notes -->
    <div class="mb-6">
        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
            Notes <span class="text-gray-400">(Catatan)</span>
        </label>
        <textarea name="notes" 
                  id="notes" 
                  rows="3"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="Tambah catatan jika perlu...">{{ old('notes', $item->notes) }}</textarea>
        @error('notes')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Total Calculation (Live Preview) -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <div class="flex justify-between items-center">
            <span class="font-medium text-gray-700">Total Gaji:</span>
            <span class="text-lg font-bold text-blue-700" id="total-salary">
                Rp {{ number_format($item->total_salary, 0, ',', '.') }}
            </span>
        </div>
        <div class="text-xs text-gray-500 mt-2">
            <span id="calculation-breakdown">
                Base: {{ number_format($item->base_salary, 0, ',', '.') }} 
                + Allowance: {{ number_format($item->allowance, 0, ',', '.') }}
                + Overtime: {{ number_format($item->overtime, 0, ',', '.') }}
                + Bonus: {{ number_format($item->bonus, 0, ',', '.') }}
                - Deduction: {{ number_format($item->deduction, 0, ',', '.') }}
            </span>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('hr.payrolls.index') }}" 
           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
            Cancel
        </a>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
            Update Payroll Item
        </button>
    </div>
</form>

<script>
// Live calculation preview
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['allowance', 'overtime', 'bonus', 'deduction'];
    const baseSalary = {{ $item->base_salary }};
    
    function calculateTotal() {
        let total = baseSalary;
        
        inputs.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                const value = parseFloat(input.value) || 0;
                if (id === 'deduction') {
                    total -= value;
                } else {
                    total += value;
                }
            }
        });
        
        // Update total display
        document.getElementById('total-salary').textContent = 
            'Rp ' + total.toLocaleString('id-ID');
        
        // Update breakdown
        updateBreakdown();
    }
    
    function updateBreakdown() {
        const breakdown = inputs.map(id => {
            const input = document.getElementById(id);
            const value = parseFloat(input.value) || 0;
            const label = input.closest('.mb-4').querySelector('label').textContent;
            const prefix = id === 'deduction' ? '-' : '+';
            
            return `${prefix} ${label.split(' ')[0]}: ${value.toLocaleString('id-ID')}`;
        }).join(' ');
        
        document.getElementById('calculation-breakdown').textContent = 
            `Base: ${baseSalary.toLocaleString('id-ID')} ${breakdown}`;
    }
    
    // Attach event listeners
    inputs.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', calculateTotal);
        }
    });
    
    // Initial calculation
    calculateTotal();
});
</script>