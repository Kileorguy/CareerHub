@props(['type', 'e' => null, 'jobSkills' => []])

@if ($type === 'insert')
    <button class="w-5" onclick="document.getElementById('skill_modal_insert').showModal()">
        <img src="assets/plus.png" alt="Add skill">
    </button>
@else
    <button class="w-5" onclick="document.getElementById('skill_modal_{{ $e->id }}').showModal()">
        <img src="assets/pencil.png" alt="Edit skill">
    </button>
@endif

<dialog id="{{ $type === 'update' ? 'skill_modal_' . $e->id : 'skill_modal_insert' }}" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                onclick="document.getElementById('{{ $type === 'update' ? 'skill_modal_' . $e->id : 'skill_modal_insert' }}').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">{{ $type === 'update' ? 'Edit Skill' : 'Add Skill' }}</h3>

        <form action="{{ $type === 'update' ? '/updateSkill/' . $e->id : '/createSkill' }}" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Skill Name</p>
            <div class="relative w-full max-w-lg">
                <input
                    id="skill-input-{{ $type === 'update' ? $e->id : 'new' }}"
                    name="skill_name"
                    type="text"
                    placeholder="Search or Add Skill Name"
                    class="input input-bordered w-full"
                    value="{{ $type === 'update' ? $e->skill_name : '' }}"
                    autocomplete="off"
                    oninput="filterSkills(this)"
                />
            <ul
                class="w-full bg-white border border-gray-200 shadow-md max-h-48 overflow-y-auto z-50 hidden"
                id="skill-list-{{ $type === 'update' ? $e->id : 'new' }}"
            >
                @foreach ($jobSkills as $skill)
                    <li
                        class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                        onclick="selectSkill('{{ $skill->skill_name }}', '{{ $type === 'update' ? $e->id : 'new' }}')"
                    >
                        {{ $skill->skill_name }}
                    </li>
                @endforeach
            </ul>

            </div>
            <input type="hidden" name="is_new_skill" id="is-new-skill-{{ $type === 'update' ? $e->id : 'new' }}" value="false">
            <button class="btn bg-primary text-white mt-4 m-auto">{{ $type === 'update' ? 'Update' : 'Save' }}</button>
        </form>
    </div>
</dialog>

<script>
    function filterSkills(inputElement) {
        const inputId = inputElement.id;
        const listId = inputId.replace('skill-input', 'skill-list');
        const list = document.getElementById(listId);
        const searchText = inputElement.value.toLowerCase();

        if (searchText.trim() === '') {
            list.classList.add('hidden');
            return;
        }

        const items = list.querySelectorAll('li');
        let hasMatch = false;
        items.forEach(item => {
            const skillName = item.textContent.toLowerCase();
            if (skillName.includes(searchText)) {
                item.style.display = 'block';
                hasMatch = true;
            } else {
                item.style.display = 'none';
            }
        });

        if (hasMatch) {
            list.classList.remove('hidden');
        } else {
            list.classList.add('hidden');
        }

        const hiddenInput = document.getElementById(inputId.replace('skill-input', 'is-new-skill'));
        hiddenInput.value = !hasMatch ? 'true' : 'false';
    }

    function selectSkill(skillName, type) {
        const inputId = `skill-input-${type}`;
        const hiddenInputId = `is-new-skill-${type}`;
        document.getElementById(inputId).value = skillName;
        document.getElementById(hiddenInputId).value = 'false';

        const listId = `skill-list-${type}`;
        document.getElementById(listId).classList.add('hidden');
    }
</script>
