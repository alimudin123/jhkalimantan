document.getElementById('searchButton').addEventListener('click', () => {
    const searchTerm = document.getElementById('search').value.toLowerCase(); // Ambil input pencarian dan ubah ke huruf kecil
    const selectedCategory = document.getElementById('category').value.toLowerCase(); // Ambil kategori yang dipilih
    const selectedGender = document.getElementById('gender').value.toLowerCase(); // Ambil gender yang dipilih
    const minPrice = parseFloat(document.getElementById('min_price').value); // Ambil harga minimum
    const maxPrice = parseFloat(document.getElementById('max_price').value); // Ambil harga maksimum

    // Validasi input harga
    if (isNaN(minPrice) && document.getElementById('min_price').value !== '') {
        alert("Harga Min harus berupa angka.");
        return;
    }
    if (isNaN(maxPrice) && document.getElementById('max_price').value !== '') {
        alert("Harga Max harus berupa angka.");
        return;
    }
    if (minPrice && maxPrice && minPrice > maxPrice) {
        alert("Harga Min tidak boleh lebih besar dari Harga Max.");
        return;
    }

    // Ambil produk yang difilter
    fetch(`produk.php?search=${searchTerm}&category=${selectedCategory}&gender=${selectedGender}&min_price=${minPrice || ''}&max_price=${maxPrice || ''}`)
        .then(response => response.json())
        .then(data => {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = ''; // Bersihkan hasil sebelumnya

            if (data.length === 0) {
                resultsContainer.innerHTML = '<p>Tidak ada produk yang ditemukan.</p>';
                return;
            }

            // Tampilkan produk yang difilter
            data.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product-item');
                productDiv.innerHTML = `
                    <h3>${product.nama}</h3>
                    <p>Kategori: ${product.kategori}</p>
                    <p>Gender: ${product.gender}</p>
                    <p>Harga: Rp ${product.harga.toLocaleString()}</p>
                `;
                resultsContainer.appendChild(productDiv);
            });
        })
        .catch(error => console.error('Error:', error));
});

// Fungsi untuk carousel produk
let currentIndex = 0;
const itemsToShow = 5; // Jumlah produk yang ditampilkan per baris
const productContainer = document.getElementById('productContainer');
const totalProducts = document.querySelectorAll('.product-item').length;

document.getElementById('nextButton').addEventListener('click', () => {
    if (currentIndex < Math.ceil(totalProducts / itemsToShow) - 1) {
        currentIndex++;
        updateCarousel();
    }
});

document.getElementById('prevButton').addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
    }
});

function updateCarousel() {
    const offset = currentIndex * (100 / itemsToShow);
    productContainer.style.transform = `translateX(-${offset}%)`;
}

// Pastikan untuk memanggil updateCarousel setelah produk ditampilkan
function displayProducts(data) {
    const resultsContainer = document.getElementById('searchResults');
    resultsContainer.innerHTML = ''; // Bersihkan hasil sebelumnya

    if (data.length === 0) {
        resultsContainer.innerHTML = '<p>Tidak ada produk yang ditemukan.</p>';
        return;
    }

    data.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('product-item');
        productDiv.innerHTML = `
            <h3>${product.nama}</h3>
            <p>Kategori: ${product.kategori}</p>
            <p>Gender: ${product.gender}</p>
            <p>Harga: Rp ${product.harga.toLocaleString()}</p>
        `;
        resultsContainer.appendChild(productDiv);
    });

    // Update carousel setelah produk ditampilkan
    updateCarousel();
}

function filterProducts() {
    const search = document.getElementById('search').value;
    const category = document.getElementById('category').value;
    const minPrice = document.getElementById('min_price').value;
    const maxPrice = document.getElementById('max_price').value;

    const params = new URLSearchParams({
        search: search,
        category: category,
        min_price: minPrice,
        max_price: maxPrice
    });

    // Redirect to the same page with query parameters
    window.location.href = `produk.php?${params.toString()}`;
}
