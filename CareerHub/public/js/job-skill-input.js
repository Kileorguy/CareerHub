document.querySelectorAll('[data-unique-id]').forEach((formInstance) => {
    const jobSkillsInput = formInstance.querySelector('[data-scope="job-skills"]');
    const jobSkillList = formInstance.querySelector('[data-scope="job-skill-list"]');
    const temporarySkillInput = formInstance.querySelector('[data-scope="temporary-skill"]');
    const addSkillButton = formInstance.querySelector('[data-scope="add-skill-btn"]');

    const initialJobSkills = jobSkillsInput.value ? JSON.parse(jobSkillsInput.value) : [];
    const jobSkillMap = initialJobSkills.reduce((acc, skill) => {
        acc[skill.toLowerCase()] = true;
        return acc;
    }, {});
    updateJobSkillList(initialJobSkills);

    addSkillButton.addEventListener('click', () => {
        const temporarySkill = temporarySkillInput.value.trim();

        if (!temporarySkill || jobSkillMap[temporarySkill.toLowerCase()]) return;
        temporarySkillInput.value = '';

        const jobSkills = jobSkillsInput.value ? JSON.parse(jobSkillsInput.value) : [];
        jobSkills.push(temporarySkill);
        jobSkillMap[temporarySkill.toLowerCase()] = true;
        jobSkillsInput.value = JSON.stringify(jobSkills);
        updateJobSkillList(jobSkills);
    });

    function deleteSkill(index) {
        const jobSkills = jobSkillsInput.value ? JSON.parse(jobSkillsInput.value) : [];
        const [removedSkill] = jobSkills.splice(index, 1);
        delete jobSkillMap[removedSkill.toLowerCase()];
        jobSkillsInput.value = JSON.stringify(jobSkills);
        updateJobSkillList(jobSkills);
    }

    function updateJobSkillList(jobSkills) {
        jobSkillList.innerHTML = jobSkills
            .map((skill, idx) => `
                <span class="flex justify-between gap-4">
                    <li class="overflow-x-hidden text-nowrap">${skill}</li>
                    <button type="button" class="btn btn-sm btn-danger" data-delete-index="${idx}">✕</button>
                </span>
            `)
            .join('');

        jobSkillList.querySelectorAll('[data-delete-index]').forEach((button) => {
            button.addEventListener('click', () => {
                deleteSkill(parseInt(button.getAttribute('data-delete-index'), 10));
            });
        });
    }
});
