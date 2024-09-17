import sys
import win32print
import win32ui
import win32con

def print_receipt(printer_name, nomor_antrian, layanan_meja):
    try:
        # Buka printer
        hprinter = win32print.OpenPrinter(printer_name)
        try:
            # Mulai dokumen baru
            hdc = win32ui.CreateDC()
            hdc.CreatePrinterDC(printer_name)
            hdc.StartDoc("Struk")
            hdc.StartPage()

            # Fungsi untuk mencetak teks dengan posisi tengah
            def print_text_centered(y, text, font_name="Arial", font_size=24, bold=False):
                font = win32ui.CreateFont({
                    "name": font_name,
                    "height": font_size,
                    "weight": win32con.FW_BOLD if bold else win32con.FW_NORMAL
                })
                hdc.SelectObject(font)
                
                # Mendapatkan lebar teks
                text_width, _ = hdc.GetTextExtent(text)
                # Menghitung posisi x agar teks berada di tengah
                page_width = hdc.GetDeviceCaps(win32con.HORZRES)
                x = (page_width - text_width) // 2  # Posisi x agar di tengah
                hdc.TextOut(x, y, text)

            # Header (Teks di tengah)
            print_text_centered(10, "Pengadilan Tinggi Banjarmasin", "Arial", 28)  # Font size 28
            print_text_centered(50, "Jalan Bina Praja Timur", "Arial", 24)  # Font size 24
            print_text_centered(90, "Banjarbaru Kalimantan Selatan 70732", "Arial", 24)  # Font size 24
            print_text_centered(130, "Telp : 0511-3354527", "Arial", 24)  # Font size 24

            # Garis pemisah
            hdc.MoveTo(10, 160)
            hdc.LineTo(300, 160)

            # Jarak (2 enter) sebelum nomor antrian
            print_text_centered(180, "", "Arial", 24)  # Enter 1
            print_text_centered(210, "", "Arial", 24)  # Enter 2

            # Nomor antrian di tengah dengan font lebih besar
            print_text_centered(240, nomor_antrian, "Arial", 100, bold=True)  # Menggunakan font lebih besar (100)

            # Jarak (2 enter) setelah nomor antrian
            print_text_centered(350, "", "Arial", 24)  # Enter 1
            print_text_centered(380, "", "Arial", 24)  # Enter 2

            # Layanan meja di tengah
            print_text_centered(410, layanan_meja, "Arial", 28)  # Font size 28

            # Terima kasih dan informasi waktu di bagian bawah
            print_text_centered(450, "Terima kasih atas kunjungan anda", "Arial", 24)  # Font size 24
            print_text_centered(490, "pt-banjarmasin.go.id", "Arial", 24)  # Font size 24
            print_text_centered(530, "17 September 2024 08:25:05", "Arial", 24)  # Font size 24

            # Selesai mencetak
            hdc.EndPage()
            hdc.EndDoc()

        finally:
            # Tutup printer
            win32print.ClosePrinter(hprinter)

    except Exception as e:
        print(f"Error: {e}", file=sys.stderr)
        sys.exit(1)

# Mengecek dan memproses argumen baris perintah
if len(sys.argv) != 4:
    print("Usage: python printer.py <printer_name> <nomor_antrian> <layanan_meja>", file=sys.stderr)
    sys.exit(1)

printer_name = sys.argv[1]
nomor_antrian = sys.argv[2]
layanan_meja = sys.argv[3]

print_receipt(printer_name, nomor_antrian, layanan_meja)

