const notification = $('.notification')[0];
const notificationContent = $('.notification-content');
const notificationBadge = $('#notification-badge');
const NOTIFICATION_PATH = 'http://localhost/MVC/public/notification';
const UPDATE_NOTIFICATION_PATH = 'http://localhost/MVC/public/notification/update';

function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function fetchNotifications() {
    $.ajax({
        url: NOTIFICATION_PATH,
        method: 'POST',
        dataType: "json",
        success: function (response) {
            if (response.count == 0) {
                notificationBadge.text('');
                notificationBadge.removeClass('badge');
            } else {
                notificationBadge.text(response.count);
                notificationBadge.addClass('badge');

                const notificationBody = $('.notification-body');

                notificationBody.empty();

                response.users.forEach(user => {
                    const username = capitalizeFirstLetter(user.username);
                    const li = $(`<li data-id="${user.id}">`).addClass('notification-item');
                    li.append(`<a class="notification-link" data-id="${user.id}">${username} has request to retrieve account</a>`);
                    notificationBody.append(li);
                });
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
}

function updateNotifications() {
    const id = $('.notification-item .notification-link').data('id');

    $.ajax({
        url: UPDATE_NOTIFICATION_PATH,
        method: 'POST',
        dataType: 'json',
        data: { id: id },
        success: function (response) {
            showAlert(response.message, 'success');
            notificationContent.toggle('show');
            fetchNotifications();
        }
    })
}

fetchNotifications();

setInterval(() => {
    fetchNotifications();
}, 5000);

$(document).on('click', '.notification .badge', function () {
    notificationContent.toggle('show');
});

$(document).on('click', '.notification-item .notification-link', function () {
    updateNotifications();
});