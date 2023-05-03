/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


// Configuration
const rows = 12;
const seatsPerRow = 18;
const seats = [];

// Generate seats
for (let i = 1; i <= rows; i++) {
  for (let j = 1; j <= seatsPerRow; j++) {
    seats.push({ row: i, seat: j, status: 'available' });
  }
}

// Update seat status
function updateSeatStatus(seatElement) {
  const seat = seats.find(s => s.row === seatElement.dataset.row && s.seat === seatElement.dataset.seat);
  if (seat.status === 'available') {
    seat.status = 'selected';
    seatElement.classList.add('selected');
  } else if (seat.status === 'selected') {
    seat.status = 'available';
    seatElement.classList.remove('selected');
  }
}

// Render seats
const seatsContainer = document.getElementById('seats-container');
seatsContainer.innerHTML = seats.map(seat => `<div class="seat" data-row="${seat.row}" data-seat="${seat.seat}" data-status="${seat.status}"></div>`).join('');

// Add event listener
seatsContainer.addEventListener('click', e => {
  if (!e.target.classList.contains('seat')) return;
  const seatElement = e.target;
  if (seatElement.dataset.status === 'available') {
    updateSeatStatus(seatElement);
  } else if (seatElement.dataset.status === 'sold') {
    alert('This seat has been sold. Please select another seat.');
  }
});

// Cancel selected seats
const cancelBtn = document.getElementById('cancel-btn');
cancelBtn.addEventListener('click', () => {
  seats.forEach(seat => {
    if (seat.status === 'selected') {
      const seatElement = document.querySelector(`[data-row="${seat.row}"][data-seat="${seat.seat}"]`);
      updateSeatStatus(seatElement);
    }
  });
});

// Purchase selected seats
const buyBtn = document.getElementById('buy-btn');
buyBtn.addEventListener('click', async () => {
  const selectedSeats = seats.filter(seat => seat.status === 'selected');
  if (selectedSeats.length === 0) {
    alert('Please select at least one seat.');
    return;
  }
  const data = { seats: selectedSeats };
  try {
    const response = await fetch('backend.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=UTF-8'
      },
      body: JSON.stringify(data)
    });
    const responseData = await response.json();
    if (responseData.success) {
      window.location.href = 'payment.php';
    } else {
      alert('Purchase failed. Please try again later.');
    }
  } catch (error) {
    console.error(error);
    alert('An error occurred. Please try again later.');
  }
});
