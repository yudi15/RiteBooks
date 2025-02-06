document.addEventListener("DOMContentLoaded", function () {
    const notificationsDropdown = document.getElementById('notifications-list');
    const notificationCountBadge = document.getElementById('notification-count');
    const userType = document.getElementById('userType').value; // Get user type (admin/user)
    const loggedInUserId = document.getElementById('loggedInUserId').value; // Get the logged-in user's ID

    if (!notificationsDropdown || !notificationCountBadge) {
        console.error("Required notification elements are missing in the DOM.");
        return;
    }

    function updateNotificationBadge(count) {
        if (count > 0) {
            notificationCountBadge.textContent = count;
            notificationCountBadge.style.display = 'inline-block';
        } else {
            notificationCountBadge.textContent = 0;
            notificationCountBadge.style.display = 'none';
        }
    }

    function fetchNotifications() {
        fetch('/Admin2 - Copy/notifications.php')
            .then(response => response.json())
            .then(data => {
                notificationsDropdown.innerHTML = ''; // Clear existing notifications

                if (data.length === 0) {
                    notificationsDropdown.innerHTML = `
                        <li class="list-group-item text-center">
                            <small>No new notifications</small>
                        </li>
                    `;
                    updateNotificationBadge(0);
                    return;
                }

                updateNotificationBadge(data.length);

                data.forEach(notification => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'list-group-item-action', 'dropdown-notifications-item');
                    listItem.innerHTML = `
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">${notification.project_name} ${notification.project_desc}</h6>
                                <small class="mb-1 d-block text-body">You have ${notification.unread_count} unread messages</small>
                            </div>
                        </div>
                    `;
                    listItem.dataset.projectId = notification.project_id;
                    listItem.dataset.userId = notification.sender_id;
                    notificationsDropdown.appendChild(listItem);
                });

                // Attach click events to the entire notification item
                attachClickEvents();
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    function attachClickEvents() {
        document.querySelectorAll('.dropdown-notifications-item').forEach(item => {
            item.addEventListener('click', function () {
                const projectId = this.dataset.projectId;
                const userId = this.dataset.userId;

                if (!projectId) {
                    console.error("Project ID not found.");
                    return;
                }

                if (userType === 'admin') {
                    if (!userId) {
                        console.error("User ID is undefined for admin.");
                        return;
                    }
                    window.location.href = `/Admin2 - Copy/projects.php?user_id=${userId}`;
                } else {
                    window.location.href = `/Admin2 - Copy/projects.php`;
                }
            });
        });
    }

    // Fetch notifications initially and refresh every 10 seconds
    fetchNotifications();
    setInterval(fetchNotifications, 10000);
});
