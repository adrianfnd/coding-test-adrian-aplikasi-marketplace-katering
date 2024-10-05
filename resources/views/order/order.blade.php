@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row" id="menu-items">
                @foreach ($menus as $menu)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ $menu->foto ? asset('storage/' . $menu->foto) : asset('no-image.png') }}" class="card-img-top" alt="{{ $menu->nama }}" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama }}</h5>
                            <p class="card-text">{{ $menu->deskripsi }}</p>
                            <p class="card-text"><strong>Jenis: </strong>{{ $menu->jenisMakanan->nama_jenis_makanan }}</p>
                            <p class="card-text"><strong>Harga: </strong>Rp. {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control quantity-input" value="0" min="0" data-menu-id="{{ $menu->id }}" data-price="{{ $menu->harga }}">
                                <button class="btn btn-outline-secondary add-to-order" type="button">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Rincian Pesanan</h4>
                </div>
                <div class="card-body">
                    <form id="order-form" action="" method="POST">
                        @csrf
                        <div id="order-items">
                        </div>
                        <div class="form-group mb-3">
                            <label for="total">Total Harga</label>
                            <input type="text" class="form-control" id="total" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.getElementById('menu-items');
        const orderItems = document.getElementById('order-items');
        const totalInput = document.getElementById('total');
        let orderTotal = 0;

        menuItems.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-to-order')) {
                const card = e.target.closest('.card');
                const quantityInput = card.querySelector('.quantity-input');
                const menuId = quantityInput.dataset.menuId;
                const menuName = card.querySelector('.card-title').textContent;
                const price = parseFloat(quantityInput.dataset.price);
                const quantity = parseInt(quantityInput.value);

                if (quantity > 0) {
                    addToOrder(menuId, menuName, price, quantity);
                    quantityInput.value = 0;
                    updateTotal();
                }
            }
        });

        function addToOrder(menuId, menuName, price, quantity) {
            const existingItem = document.getElementById(`order-item-${menuId}`);
            if (existingItem) {
                const existingQuantity = parseInt(existingItem.dataset.quantity);
                const newQuantity = existingQuantity + quantity;
                existingItem.dataset.quantity = newQuantity;
                existingItem.querySelector('.item-quantity').textContent = newQuantity;
                existingItem.querySelector('.item-total').textContent = `Rp. ${(price * newQuantity).toLocaleString('id-ID')}`;
            } else {
                const itemHtml = `
                    <div id="order-item-${menuId}" class="order-item mb-2" data-quantity="${quantity}">
                        <input type="hidden" name="menu_id[]" value="${menuId}">
                        <input type="hidden" name="quantity[]" value="${quantity}">
                        <div class="d-flex justify-content-between">
                            <span>${menuName} x <span class="item-quantity">${quantity}</span></span>
                            <span class="item-total">Rp. ${(price * quantity).toLocaleString('id-ID')}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger remove-item">Hapus</button>
                    </div>
                `;
                orderItems.insertAdjacentHTML('beforeend', itemHtml);
            }
        }

        orderItems.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.order-item').remove();
                updateTotal();
            }
        });

        function updateTotal() {
            orderTotal = 0;
            document.querySelectorAll('.order-item').forEach(item => {
                const quantity = parseInt(item.dataset.quantity);
                const price = parseFloat(item.querySelector('.item-total').textContent.replace('Rp. ', '').replace(/\./g, '').replace(',', '.'));
                orderTotal += price;
            });
            totalInput.value = `Rp. ${orderTotal.toLocaleString('id-ID', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
        }
    });
</script>
@endsection
