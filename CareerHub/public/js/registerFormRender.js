document.addEventListener('DOMContentLoaded', () => {
    const roleInput = document.getElementById('role')
    const companyDetailForm = document.getElementById('company-detail-form')
    const employeeDetailForm = document.getElementById('employee-detail-form')

    function toggleRoleInput() {
        if (roleInput.value === 'Company') {
            companyDetailForm.style.display = 'flex';
            employeeDetailForm.style.display = 'none';
        } else {
            companyDetailForm.style.display = 'none';
            employeeDetailForm.style.display = 'flex';
        }
    }
    toggleRoleInput();

    roleInput.addEventListener('change', toggleRoleInput);

})
