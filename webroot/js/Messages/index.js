function getMessages() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
            function (messages) {
                var messageTable = $('#messageData');
                messageTable.empty();

                $.each(messages.data, function (key, value)
                {
                    var viewEditDeleteButtons = '</td><td>' +
                        '<a href="javascript:void(0);" onclick="getMessage(' + value.id + ')" class="btn btn-primary btn-sm" role="button"><i class="fas fa-chevron-down fa-lg" id="iconVoir'+ value.id +'"></i></a>' +
                        '<a href="javascript:void(0);" onclick="editMessage(' + value.id + ')" class="btn btn-primary btn-sm" role="button"><i class="fas fa-pencil-alt fa-lg"></i></a>' +
                        '<a href="javascript:void(0);" onclick="return confirm(\'Are you sure to delete data?\') ? messageAction(\'delete\', ' + value.id + ') : false;" class="btn btn-primary btn-sm" role="button"><i class="fas fa-trash fa-lg"></i></a>' +
                        '</td></tr>';
                    messageTable.append('<tr><td>' + formaterDate(value.created) + '</td><td class="w-50">' + value.titre + viewEditDeleteButtons);
                    messageTable.append('<tr class="w-100" style="display: none;" id="table'+ value.id +'"><td colspan="3"><div style="display: none;" id="voir'+ value.id +'"><h5>Message:</h5><br><p id="message'+ value.id +'"></p></div></td>' + value.message + '</tr>');
                });

            }
    });
}

/* Function takes a jquery form
 and converts it to a JSON dictionary */
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}

function formaterDate(created) {
    var date = new Date(created);
    annee = date.getFullYear().toString().substr(2);
    mois = date.getMonth()+1;
    jour = date.getDate();
    heure = date.getHours();
    min = date.getMinutes();

    if (jour < 10) {
        jour = '0' + jour;
    }
    if (mois < 10) {
        mois = '0' + mois;
    }
    if(heure<10){
        heure = '0' + heure;
    }
    if(min<10){
        min = '0' + min;
    }
    return annee+'-'+mois+'-'+jour + ' ' + heure +':' + min;
}

/*
 $('#messageAddForm').submit(function (e) {
 e.preventDefault();
 var data = convertFormToJSON($(this));
 alert(data);
 console.log(data);
 });
 */

function messageAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var messageData = '';
    var ajaxUrl = urlToRestApi;
    if (type == 'add') {
        requestType = 'POST';
        messageData = convertFormToJSON($("#addForm").find('.form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        messageData = convertFormToJSON($("#editForm").find('.form'));
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        headers: {
            Accept: "application/json",
            contentType: "application/json"
        },
        contentType: "application/json",
        data: JSON.stringify(messageData),
        success: function (msg) {
            if (msg) {
                alert('Message data has been ' + statusArr[type] + ' successfully.');
                getMessages();
                $('.form')[0].reset();
                $('.formData').slideUp();
            } else {
                alert('Some problem occurred, please try again.');
            }
        }
    });
}

function editMessage(id) {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: urlToRestApi+ "/" + id,
        success: function (data) {
            $('#idEdit').val(data.data.id);
            $('#titreEdit').val(data.data.titre);
            $('#messageEdit').val(data.data.message);
            $('#editForm').slideDown();
        }
    });
}

function getMessage(id) {
    var idMessageBox = "#voir" + id;
    var idMessageText = "#message" + id;
    var idTable = "#table" + id;
    var icon = "#iconVoir" + id;
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: urlToRestApi+ "/" + id,
        success: function (data) {
            $(idMessageText).text(data.data.message);
            $(idTable).slideToggle(325);
            $(idMessageBox).slideToggle();
            $(icon).toggleClass("fa-chevron-down fa-chevron-up");
        }
    });
}