function createSmartSelect({ selectId, inputId, searchUrl, storeUrl, fieldName, getExtraParams = () => ({}), onSelect = () => { }, onCreate = () => { } }) {
    const select = document.getElementById(selectId);
    if (!select) return;

    select.style.display = 'none';

    const input = document.getElementById(inputId);
    if (!input) return;

    const wrapper = input.parentNode;
    wrapper.style.position = 'relative';

    let dropdown = wrapper.querySelector('.custom-dropdown');
    if (!dropdown) {
        dropdown = document.createElement('div');
        dropdown.classList.add('custom-dropdown');
        wrapper.appendChild(dropdown);
    }

    function renderDropdown(items, query) {
        dropdown.innerHTML = '';
        if (items.length > 0) {
            items.forEach(item => {
                const option = document.createElement('div');
                option.classList.add('dropdown-item');
                option.textContent = item[fieldName];
                option.dataset.id = item.id;
                option.style.cursor = 'pointer';

                option.addEventListener('click', () => {
                    select.value = item.id;
                    input.value = item[fieldName];
                    dropdown.style.display = 'none';
                    select.dispatchEvent(new Event('change'));
                    onSelect(item); // ✅ chama a função onSelect se fornecida
                });


                dropdown.appendChild(option);
            });
        } else if (query) {
            const message = document.createElement('div');
            message.classList.add('dropdown-item', 'text-muted');
            message.innerHTML = `Nenhum valor encontrado. <strong>Adicionar:</strong> ${query}`;
            message.style.cursor = 'pointer';
            message.addEventListener('click', () => {
                storeNewOption(query);
            });
            dropdown.appendChild(message);
        }

        dropdown.style.display = 'block';
    }

    function search(query) {
        if (!query) {
            dropdown.style.display = 'none';
            return;
        }

        const extraParams = getExtraParams();
        const brandId = extraParams.device_brand_id;

        const url = `${searchUrl}?q=${encodeURIComponent(query)}${brandId ? `&device_brand_id=${brandId}` : ''}`;

        fetch(url)
            .then(res => res.json())
            .then(data => renderDropdown(data, query))
            .catch(() => {
                dropdown.style.display = 'none';
            });
    }

    function storeNewOption(name) {
        const extraParams = getExtraParams();
        console.log('Params enviados para criação:', extraParams); // 👈

        const data = { [fieldName]: name, ...getExtraParams() };

        fetch(storeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(newItem => {
                const matchingOption = [...select.options].find(o => o.value == newItem.id);
                if (!matchingOption) {
                    const option = document.createElement('option');
                    option.value = newItem.id;
                    option.textContent = newItem[fieldName];
                    option.selected = true;
                    select.appendChild(option);
                }

                onCreate(newItem);

                select.value = newItem.id;  // muito importante
                input.value = newItem[fieldName];
                select.dispatchEvent(new Event('change'));
                dropdown.style.display = 'none';
            })
            .catch(() => alert('Erro ao salvar o item.'));
    }

    input.addEventListener('input', () => {
        const query = input.value.trim();
        if (query.length === 0) {
            dropdown.style.display = 'none';
            select.value = '';
            return;
        }
        search(query);
    });

    input.addEventListener('focus', () => {
        search(input.value.trim());
    });

    document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });

    if (select.value) {
        const selectedOption = [...select.options].find(opt => opt.value == select.value);
        if (selectedOption) {
            input.value = selectedOption.textContent;
        }
    }
}

