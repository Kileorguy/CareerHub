document.addEventListener('DOMContentLoaded', () => {
    const roleInput = document.getElementById('role')
    const companyDetailForm = document.getElementById('company-detail-form')

    function toggleRoleInput() {
        if (roleInput.value === 'Company') {
            companyDetailForm.style.display = 'flex';
        } else {
            companyDetailForm.style.display = 'none';
        }
    }
    toggleRoleInput();

    roleInput.addEventListener('change', toggleRoleInput);

})
