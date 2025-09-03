import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { AppShell } from '@/components/app-shell';

export default function Welcome() {
    return (
        <AppShell>
            <Head title="Selamat Datang - KostKu Management" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Hero Section */}
                <div className="relative overflow-hidden">
                    <div className="absolute inset-0">
                        <div className="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
                    </div>
                    
                    <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
                        <div className="text-center">
                            <h1 className="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                                🏠 <span className="text-blue-600">KostKu</span> Management
                            </h1>
                            <p className="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                                Sistem manajemen kost modern untuk mengelola properti, penghuni, dan pembayaran dengan mudah
                            </p>
                            
                            <div className="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                                <Link href="/login">
                                    <Button size="lg" className="w-full sm:w-auto text-lg px-8 py-3">
                                        🚀 Masuk ke Dashboard
                                    </Button>
                                </Link>
                                <Link href="/register">
                                    <Button variant="outline" size="lg" className="w-full sm:w-auto text-lg px-8 py-3">
                                        📝 Daftar Sekarang
                                    </Button>
                                </Link>
                            </div>
                        </div>
                        
                        {/* Feature Cards */}
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
                            <div className="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border">
                                <div className="text-3xl mb-4">🏢</div>
                                <h3 className="text-lg font-semibold mb-2 text-gray-900 dark:text-white">
                                    Multi Kost
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">
                                    Kelola multiple kost dalam satu platform dengan sistem multi-tenant
                                </p>
                            </div>
                            
                            <div className="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border">
                                <div className="text-3xl mb-4">🛏️</div>
                                <h3 className="text-lg font-semibold mb-2 text-gray-900 dark:text-white">
                                    Manajemen Kamar
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">
                                    Kelola ketersediaan kamar, fasilitas, dan harga dengan sistem yang terintegrasi
                                </p>
                            </div>
                            
                            <div className="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border">
                                <div className="text-3xl mb-4">👥</div>
                                <h3 className="text-lg font-semibold mb-2 text-gray-900 dark:text-white">
                                    Database Penghuni
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">
                                    Simpan data penghuni lengkap dengan dokumen dan riwayat pembayaran
                                </p>
                            </div>
                            
                            <div className="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border">
                                <div className="text-3xl mb-4">💰</div>
                                <h3 className="text-lg font-semibold mb-2 text-gray-900 dark:text-white">
                                    Payment Tracking
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">
                                    Otomatis generate tagihan dan track pembayaran dengan invoice digital
                                </p>
                            </div>
                        </div>
                        
                        {/* Additional Features */}
                        <div className="mt-16 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-2xl p-8 shadow-xl">
                            <h2 className="text-2xl md:text-3xl font-bold text-center mb-8 text-gray-900 dark:text-white">
                                ✨ Fitur Unggulan
                            </h2>
                            
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">📊</div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Laporan Keuangan</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            Dashboard analytics dengan grafik pemasukan dan pengeluaran
                                        </p>
                                    </div>
                                </div>
                                
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">📅</div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Booking Online</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            Sistem reservasi kamar dengan konfirmasi otomatis
                                        </p>
                                    </div>
                                </div>
                                
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">🔔</div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Smart Notifications</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            Reminder pembayaran dan notifikasi jatuh tempo
                                        </p>
                                    </div>
                                </div>
                                
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">📱</div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Mobile Responsive</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            Akses dari smartphone dengan UI yang optimal
                                        </p>
                                    </div>
                                </div>
                                
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">🔐</div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Multi User Role</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            Admin, Staff, dan Penghuni dengan akses level berbeda
                                        </p>
                                    </div>
                                </div>
                                
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">🌙</div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Dark Mode</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            Interface modern dengan dukungan tema gelap
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {/* CTA Section */}
                        <div className="mt-16 text-center">
                            <h2 className="text-2xl md:text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                                Siap Mulai Mengelola Kost Anda? 🎯
                            </h2>
                            <p className="text-gray-600 dark:text-gray-300 mb-8 text-lg">
                                Bergabunglah dengan ratusan pemilik kost yang sudah merasakan kemudahan KostKu
                            </p>
                            
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link href="/register">
                                    <Button size="lg" className="w-full sm:w-auto text-lg px-10 py-4">
                                        🎉 Daftar Gratis Sekarang
                                    </Button>
                                </Link>
                                <Link href="/login">
                                    <Button variant="outline" size="lg" className="w-full sm:w-auto text-lg px-10 py-4">
                                        🔑 Sudah Punya Akun?
                                    </Button>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}