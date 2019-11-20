$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter
    $('#ville-id').on('change', function () {
        var villeId = $(this).val();
        if (villeId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'ville_id=' + villeId,
                success: function (institutions) {
                    $select = $('#institution-id');
                    $select.find('option').remove();
                    $.each(institutions, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.name + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#institution-id').html('<option value="">Choisissez une ville d\'abord</option>');
        }
    });
});