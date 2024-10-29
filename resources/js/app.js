import './bootstrap';

console.log('hello')
function initFishTypeSelect(selector) {
    return $(selector).select2({
        placeholder: "Pilih Jenis Ikan",
        tokenSeparators: [','],
        allowClear: true,
        tags: true,
        ajax: {
            url: '{{ route("fish-types.search") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.nama,
                            text: item.nama
                        };
                    })
                };
            },
            cache: true
        },
        createTag: function(params) {
            const term = $.trim(params.term);
            if (term === '') {
                return null;
            }

            // Cek apakah nilai sudah ada di opsi yang ada
            const exists = $(this).find('option').filter(function() {
                return $(this).val().toLowerCase() === term.toLowerCase();
            }).length > 0;

            if (exists) {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            };
        }
    });
}
