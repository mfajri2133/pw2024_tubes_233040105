// Ambil elemen-elemen yang dibutuhkan
let sidebar = document.getElementById("logo-sidebar");
let sidebarToggleButton = document.querySelector(
     '[data-drawer-toggle="logo-sidebar"]'
);

// Fungsi untuk membuka sidebar
function openSidebar() {
     sidebar.classList.remove("-translate-x-full");
}

// Fungsi untuk menutup sidebar
function closeSidebar() {
     sidebar.classList.add("-translate-x-full");
}

// Tambahkan event listener pada tombol sidebar
sidebarToggleButton.addEventListener("click", () => {
     if (sidebar.classList.contains("-translate-x-full")) {
          openSidebar();
     } else {
          closeSidebar();
     }
});

// Tambahkan event listener untuk menutup sidebar saat layar diubah menjadi tampilan dekstop
window.addEventListener("resize", () => {
     if (window.innerWidth >= 768) {
          openSidebar();
     } else {
          closeSidebar(); // tambahkan penutupan sidebar saat lebar layar kurang dari 768px
     }
});

// Tambahkan event listener untuk menutup sidebar saat layar berubah menjadi tampilan mobile
if (window.innerWidth < 768) {
     closeSidebar();
}
