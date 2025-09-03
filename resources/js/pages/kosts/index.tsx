import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';

interface Kost {
    id: number;
    name: string;
    slug: string;
    city: string;
    province: string;
    address: string;
    gender_type: string;
    kost_type: string;
    rooms_count: number;
    tenants_count: number;
    is_active: boolean;
    created_at: string;
    categories: Array<{
        id: number;
        name: string;
        icon: string;
    }>;
}

interface Stats {
    total_kosts: number;
    total_rooms: number;
    occupied_rooms: number;
    total_tenants: number;
}

interface Props {
    kosts: {
        data: Kost[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    stats: Stats;
    [key: string]: unknown;
}

const breadcrumbs = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Kost', href: '/kosts' },
];

export default function KostsIndex({ kosts, stats }: Props) {
    const occupancyRate = stats.total_rooms > 0 
        ? Math.round((stats.occupied_rooms / stats.total_rooms) * 100) 
        : 0;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Kelola Kost - KostKu Management" />
            
            <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🏢 Kelola Kost
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Manajemen properti kost Anda
                        </p>
                    </div>
                    
                    <Link href="/kosts/create">
                        <Button size="lg">
                            ➕ Tambah Kost Baru
                        </Button>
                    </Link>
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
                                    {stats.total_kosts}
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
                                    {stats.total_rooms}
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
                                    {stats.total_tenants}
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

                {/* Kost List */}
                <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border">
                    <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
                            Daftar Kost
                        </h2>
                    </div>
                    
                    {kosts.data.length > 0 ? (
                        <div className="divide-y divide-gray-200 dark:divide-gray-700">
                            {kosts.data.map((kost) => (
                                <div key={kost.id} className="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div className="flex flex-col md:flex-row md:items-center md:justify-between">
                                        <div className="flex-1">
                                            <div className="flex items-start space-x-4">
                                                <div className="flex-shrink-0">
                                                    <div className="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                        <span className="text-2xl text-white">🏠</span>
                                                    </div>
                                                </div>
                                                
                                                <div className="flex-1">
                                                    <div className="flex items-center space-x-2 mb-1">
                                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                                            {kost.name}
                                                        </h3>
                                                        {!kost.is_active && (
                                                            <span className="text-xs bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-200 px-2 py-1 rounded">
                                                                Nonaktif
                                                            </span>
                                                        )}
                                                    </div>
                                                    
                                                    <p className="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                                        📍 {kost.address}, {kost.city}, {kost.province}
                                                    </p>
                                                    
                                                    <div className="flex flex-wrap gap-2 mb-3">
                                                        <span className="text-xs bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-200 px-2 py-1 rounded">
                                                            {kost.gender_type === 'putra' ? '👨 Putra' : 
                                                             kost.gender_type === 'putri' ? '👩 Putri' : '👫 Campur'}
                                                        </span>
                                                        <span className="text-xs bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200 px-2 py-1 rounded">
                                                            {kost.kost_type === 'reguler' ? 'Reguler' : 'Eksklusif'}
                                                        </span>
                                                        {kost.categories.slice(0, 3).map((category) => (
                                                            <span key={category.id} className="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">
                                                                {category.name}
                                                            </span>
                                                        ))}
                                                        {kost.categories.length > 3 && (
                                                            <span className="text-xs text-gray-500">
                                                                +{kost.categories.length - 3} lainnya
                                                            </span>
                                                        )}
                                                    </div>
                                                    
                                                    <div className="flex items-center space-x-6 text-sm text-gray-500">
                                                        <span className="flex items-center">
                                                            <span className="text-lg mr-1">🛏️</span>
                                                            {kost.rooms_count} kamar
                                                        </span>
                                                        <span className="flex items-center">
                                                            <span className="text-lg mr-1">👥</span>
                                                            {kost.tenants_count} penghuni
                                                        </span>
                                                        <span className="flex items-center">
                                                            <span className="text-lg mr-1">📅</span>
                                                            {new Date(kost.created_at).toLocaleDateString('id-ID')}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div className="flex space-x-2 mt-4 md:mt-0">
                                            <Link href={`/kosts/${kost.id}`}>
                                                <Button variant="outline" size="sm">
                                                    👁️ Lihat
                                                </Button>
                                            </Link>
                                            <Link href={`/kosts/${kost.id}/edit`}>
                                                <Button variant="outline" size="sm">
                                                    ✏️ Edit
                                                </Button>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="p-12 text-center">
                            <div className="text-6xl mb-4">🏠</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Belum Ada Kost
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 mb-6">
                                Mulai dengan menambahkan kost pertama Anda
                            </p>
                            <Link href="/kosts/create">
                                <Button>
                                    ➕ Tambah Kost Pertama
                                </Button>
                            </Link>
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {kosts.data.length > 0 && kosts.links.length > 3 && (
                    <div className="flex justify-center">
                        <div className="flex space-x-1">
                            {kosts.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    className={`px-3 py-2 text-sm rounded-lg ${
                                        link.active
                                            ? 'bg-blue-600 text-white'
                                            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'
                                    } ${!link.url ? 'cursor-not-allowed opacity-50' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}