import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';

interface Props {
    kosts?: Array<{
        id: number;
        name: string;
        city: string;
        rooms_count: number;
        tenants_count: number;
        gender_type: string;
        kost_type: string;
    }>;
    stats?: {
        total_kosts: number;
        total_rooms: number;
        occupied_rooms: number;
        total_tenants: number;
        monthly_revenue: number;
        pending_payments: number;
    };
    [key: string]: unknown;
}

const breadcrumbs = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ kosts = [], stats }: Props) {
    const occupancyRate = stats && stats.total_rooms > 0 
        ? Math.round((stats.occupied_rooms / stats.total_rooms) * 100) 
        : 0;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard - KostKu Management" />
            
            <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            📊 Dashboard KostKu
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Ringkasan manajemen kost Anda
                        </p>
                    </div>
                    
                    <div className="flex gap-3 mt-4 md:mt-0">
                        <Link href="/kosts/create">
                            <Button>
                                ➕ Tambah Kost
                            </Button>
                        </Link>
                        <Link href="/kosts">
                            <Button variant="outline">
                                🏠 Lihat Semua Kost
                            </Button>
                        </Link>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border">
                        <div className="flex items-center">
                            <div className="p-3 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                                <span className="text-2xl">🏢</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Kost
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {stats?.total_kosts || 0}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border">
                        <div className="flex items-center">
                            <div className="p-3 bg-green-100 dark:bg-green-900/20 rounded-lg">
                                <span className="text-2xl">🛏️</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Kamar
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {stats?.total_rooms || 0}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border">
                        <div className="flex items-center">
                            <div className="p-3 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                                <span className="text-2xl">👥</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Penghuni Aktif
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {stats?.total_tenants || 0}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border">
                        <div className="flex items-center">
                            <div className="p-3 bg-orange-100 dark:bg-orange-900/20 rounded-lg">
                                <span className="text-2xl">📈</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Tingkat Hunian
                                </p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {occupancyRate}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border">
                    <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        🚀 Aksi Cepat
                    </h2>
                    
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <Link href="/kosts/create">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-2xl mb-1">🏠</span>
                                <span className="text-sm">Tambah Kost</span>
                            </Button>
                        </Link>
                        
                        <Link href="/rooms/create">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-2xl mb-1">🛏️</span>
                                <span className="text-sm">Tambah Kamar</span>
                            </Button>
                        </Link>
                        
                        <Link href="/tenants">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-2xl mb-1">👤</span>
                                <span className="text-sm">Kelola Penghuni</span>
                            </Button>
                        </Link>
                        
                        <Link href="/payments">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-2xl mb-1">💰</span>
                                <span className="text-sm">Kelola Pembayaran</span>
                            </Button>
                        </Link>
                    </div>
                </div>

                {/* Recent Activity or Kost List */}
                {kosts.length > 0 ? (
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border">
                        <div className="flex items-center justify-between mb-4">
                            <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
                                🏢 Kost Anda
                            </h2>
                            <Link href="/kosts">
                                <Button variant="ghost" size="sm">
                                    Lihat Semua →
                                </Button>
                            </Link>
                        </div>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {kosts.slice(0, 6).map((kost) => (
                                <Link key={kost.id} href={`/kosts/${kost.id}`}>
                                    <div className="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <h3 className="font-semibold text-gray-900 dark:text-white mb-2">
                                            {kost.name}
                                        </h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            📍 {kost.city}
                                        </p>
                                        <div className="flex justify-between text-xs text-gray-500">
                                            <span>{kost.rooms_count} kamar</span>
                                            <span>{kost.tenants_count} penghuni</span>
                                        </div>
                                        <div className="flex gap-2 mt-2">
                                            <span className="text-xs bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-200 px-2 py-1 rounded">
                                                {kost.gender_type}
                                            </span>
                                            <span className="text-xs bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200 px-2 py-1 rounded">
                                                {kost.kost_type}
                                            </span>
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                ) : (
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border text-center">
                        <div className="text-6xl mb-4">🏠</div>
                        <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            Belum Ada Kost
                        </h2>
                        <p className="text-gray-600 dark:text-gray-400 mb-6">
                            Mulai dengan menambahkan kost pertama Anda
                        </p>
                        <Link href="/kosts/create">
                            <Button size="lg">
                                ➕ Tambah Kost Pertama
                            </Button>
                        </Link>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}