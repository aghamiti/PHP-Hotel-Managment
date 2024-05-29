document.addEventListener("DOMContentLoaded", () => {
    const checkAvailabilityButton = document.querySelector("#bookingForm button[type='button']");
    const modal = document.getElementById("roomModal");
    const closeModal = document.getElementById("closeModal");
    const roomDetails = document.getElementById("roomDetails").querySelector('.row');
    const bookButton = document.getElementById("formBtn");

    checkAvailabilityButton.addEventListener("click", (event) => {
        event.preventDefault();
        validateDates();
        validateAdults();
        checkAvailability();
    });

    closeModal.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    const validateDates = () => {
        // ... (existing validation logic)
    };

    const validateAdults = () => {
        // ... (existing validation logic)
    };

    const checkAvailability = () => {
        const formData = new FormData(document.getElementById('bookingForm'));
        
        fetch('../API/CheckAvailability.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => displayRoomDetails(data))
        .catch(error => console.error('Error:', error));
    };

    const displayRoomDetails = (rooms) => {
        roomDetails.innerHTML = '';
        rooms.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.classList.add('col-md-4', 'room-card');
            roomCard.innerHTML = `
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">${room.RoomType}</h5>
                        <p class="card-text">Capacity: ${room.Capacity} guests</p>
                        <p class="card-text">Price per night: $${room.Price.toFixed(2)}</p>
                        <button class="btn btn-outline-primary select-room-btn" data-room-id="${room.RoomID}">Select</button>
                    </div>
                </div>
            `;
            roomDetails.appendChild(roomCard);
        });

        modal.style.display = "block";

        document.querySelectorAll('.select-room-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const roomId = event.target.getAttribute('data-room-id');
                bookButton.setAttribute('data-room-id', roomId);
            });
        });
    };

    bookButton.addEventListener('click', () => {
        const roomId = bookButton.getAttribute('data-room-id');
        if (roomId) {
            bookRoom(roomId);
        } else {
            alert('Please select a room.');
        }
    });

    const bookRoom = (roomId) => {
        const formData = new FormData(document.getElementById('bookingForm'));
        formData.append('RoomID', roomId);

        fetch('../API/BookRoom.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Room booked successfully!');
            modal.style.display = "none";
        })
        .catch(error => console.error('Error:', error));
    };
});
