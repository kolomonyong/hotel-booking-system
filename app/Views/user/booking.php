<!-- app/Views/user/booking.php -->
<?= $this->extend('admin/layout/main_user') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="<?= site_url('user/booking/store') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="room_id" class="form-label">Room</label>
                    <select name="room_id" id="room_id" class="form-control" required onchange="calculateTotalPrice()">
                        <?php foreach ($rooms as $room): ?>
                            <option value="<?= $room['id'] ?>" data-price="<?= $room['harga'] ?>">
                                <?= $room['tipe_kamar'] ?> - Rp<?= $room['harga'] ?> per Malam
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="num_rooms" class="form-label">Jumlah Kamar</label>
                    <input type="number" name="num_rooms" id="num_rooms" class="form-control" min="1" value="1" required onchange="calculateTotalPrice()">
                </div>

                <div class="mb-3">
                    <label for="checkin_date" class="form-label">Check-in</label>
                    <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="checkout_date" class="form-label">Check-out</label>
                    <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="number" name="total_price" id="total_price" class="form-control" readonly required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Book Now</button>
            </form>
        </div>
    </div>
</div>

<script>
    // This function calculates the total price when the user selects the number of rooms or changes the room
    function calculateTotalPrice() {
        const roomSelect = document.getElementById('room_id');
        const roomPrice = parseFloat(roomSelect.options[roomSelect.selectedIndex].dataset.price);
        const numRooms = parseInt(document.getElementById('num_rooms').value);
        const totalPrice = roomPrice * numRooms;
        document.getElementById('total_price').value = totalPrice.toFixed(2);
    }

    // Initial calculation when the page loads
    window.onload = calculateTotalPrice;
</script>

<?= $this->endSection() ?>
