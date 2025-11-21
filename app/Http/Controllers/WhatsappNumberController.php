<?php
namespace App\Http\Controllers;

use App\Models\WhatsappNumber;
use Illuminate\Http\Request;

class WhatsappNumberController extends Controller
{
    public function index()
    {
        $whatsappNumbers = WhatsappNumber::orderBy('page_name')->get();

        $pages = [
            'Home' => 'Semua Halaman',
            'About' => 'Tentang Kami',
            'Custom' => 'Custom Jersey',
            'ProductPage' => 'Page per Produk',
            'OurProduct' => 'Our Product',
            'Cart' => 'Cart',
            'Testimonial' => 'Testimonial',
        ];

        $positions = [
            'footer' => 'Footer',
            'product_card' => 'Product Card',
            'cart_section' => 'Cart Section',
            'custom_section' => 'Custom Section',
        ];

        return view('admin.whatsapp-numbers.index', compact('whatsappNumbers', 'pages', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'display_name' => 'required|string|max:255',
            'message' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        WhatsappNumber::create($request->only(['page_name', 'position', 'phone_number', 'display_name', 'message', 'is_active']));

        return redirect()->route('admin.whatsapp-numbers.index')
            ->with('success', 'Nomor WhatsApp berhasil ditambahkan!');
    }

    public function update(Request $request, WhatsappNumber $whatsappNumber)
    {
        $request->validate([
            'page_name' => 'required|string|max:50', // Ganti position jadi page_name
            'phone_number' => 'required|string|max:20',
            'display_name' => 'required|string|max:255',
            'message' => 'nullable|string|max:500',
            'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['page_name', 'phone_number', 'display_name', 'message', 'is_active']);

        $whatsappNumber->update($data);

        return redirect()->route('admin.whatsapp-numbers.index')
            ->with('success', 'Nomor WhatsApp berhasil diperbarui!');
    }

    public function destroy(WhatsappNumber $whatsappNumber)
    {
        $whatsappNumber->delete();

        return redirect()->route('admin.whatsapp-numbers.index')
            ->with('success', 'Nomor WhatsApp berhasil dihapus!');
    }
}
