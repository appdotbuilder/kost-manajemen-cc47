import React from 'react';
import { Head, useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';

interface Category {
    id: number;
    name: string;
    type: string;
    icon: string;
}

interface Props {
    categories: Category[];
    [key: string]: unknown;
}

interface KostFormData {
    name: string;
    address: string;
    city: string;
    province: string;
    postal_code: string;
    phone: string;
    email: string;
    description: string;
    rules: string;
    facilities: string;
    gender_type: string;
    kost_type: string;
    categories: number[];
    [key: string]: string | number | number[] | boolean;
}

const breadcrumbs = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Kost', href: '/kosts' },
    { title: 'Tambah Kost', href: '/kosts/create' },
];

export default function CreateKost({ categories }: Props) {
    const { data, setData, post, processing, errors } = useForm<KostFormData>({
        name: '',
        address: '',
        city: '',
        province: '',
        postal_code: '',
        phone: '',
        email: '',
        description: '',
        rules: '',
        facilities: '',
        gender_type: 'campur',
        kost_type: 'reguler',
        categories: [],
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/kosts');
    };

    const handleCategoryChange = (categoryId: number) => {
        const updatedCategories = data.categories.includes(categoryId)
            ? data.categories.filter(id => id !== categoryId)
            : [...data.categories, categoryId];
        setData('categories', updatedCategories);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah Kost - KostKu Management" />
            
            <div className="p-6">
                <div className="max-w-4xl mx-auto">
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-sm border">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                ➕ Tambah Kost Baru
                            </h1>
                            <p className="text-gray-600 dark:text-gray-400 mt-1">
                                Lengkapi informasi kost yang akan dikelola
                            </p>
                        </div>
                        
                        <form onSubmit={handleSubmit} className="p-6 space-y-6">
                            {/* Basic Information */}
                            <div className="space-y-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    📝 Informasi Dasar
                                </h3>
                                
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Nama Kost *
                                        </label>
                                        <input
                                            type="text"
                                            value={data.name}
                                            onChange={(e) => setData('name', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Kost Sejahtera"
                                        />
                                        {errors.name && (
                                            <p className="text-red-500 text-sm mt-1">{errors.name}</p>
                                        )}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Nomor Telepon
                                        </label>
                                        <input
                                            type="text"
                                            value={data.phone}
                                            onChange={(e) => setData('phone', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="081234567890"
                                        />
                                        {errors.phone && (
                                            <p className="text-red-500 text-sm mt-1">{errors.phone}</p>
                                        )}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Email
                                    </label>
                                    <input
                                        type="email"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="kost@email.com"
                                    />
                                    {errors.email && (
                                        <p className="text-red-500 text-sm mt-1">{errors.email}</p>
                                    )}
                                </div>
                            </div>

                            {/* Address Information */}
                            <div className="space-y-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    📍 Alamat & Lokasi
                                </h3>
                                
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Alamat Lengkap *
                                    </label>
                                    <textarea
                                        value={data.address}
                                        onChange={(e) => setData('address', e.target.value)}
                                        rows={3}
                                        className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Jl. Merdeka No. 123, RT/RW 01/02, Kelurahan..."
                                    />
                                    {errors.address && (
                                        <p className="text-red-500 text-sm mt-1">{errors.address}</p>
                                    )}
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Kota *
                                        </label>
                                        <input
                                            type="text"
                                            value={data.city}
                                            onChange={(e) => setData('city', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Jakarta"
                                        />
                                        {errors.city && (
                                            <p className="text-red-500 text-sm mt-1">{errors.city}</p>
                                        )}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Provinsi *
                                        </label>
                                        <input
                                            type="text"
                                            value={data.province}
                                            onChange={(e) => setData('province', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="DKI Jakarta"
                                        />
                                        {errors.province && (
                                            <p className="text-red-500 text-sm mt-1">{errors.province}</p>
                                        )}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Kode Pos *
                                        </label>
                                        <input
                                            type="text"
                                            value={data.postal_code}
                                            onChange={(e) => setData('postal_code', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="12345"
                                        />
                                        {errors.postal_code && (
                                            <p className="text-red-500 text-sm mt-1">{errors.postal_code}</p>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* Kost Type & Gender */}
                            <div className="space-y-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    🏷️ Tipe & Kategori
                                </h3>
                                
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Jenis Kelamin *
                                        </label>
                                        <select
                                            value={data.gender_type}
                                            onChange={(e) => setData('gender_type', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        >
                                            <option value="campur">👫 Campur</option>
                                            <option value="putra">👨 Putra</option>
                                            <option value="putri">👩 Putri</option>
                                        </select>
                                        {errors.gender_type && (
                                            <p className="text-red-500 text-sm mt-1">{errors.gender_type}</p>
                                        )}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Tipe Kost *
                                        </label>
                                        <select
                                            value={data.kost_type}
                                            onChange={(e) => setData('kost_type', e.target.value)}
                                            className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        >
                                            <option value="reguler">🏠 Reguler</option>
                                            <option value="eksklusif">⭐ Eksklusif</option>
                                        </select>
                                        {errors.kost_type && (
                                            <p className="text-red-500 text-sm mt-1">{errors.kost_type}</p>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* Categories */}
                            <div className="space-y-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    🏷️ Kategori Fasilitas
                                </h3>
                                <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    {categories.map((category) => (
                                        <label key={category.id} className="flex items-center space-x-2 cursor-pointer">
                                            <input
                                                type="checkbox"
                                                checked={data.categories.includes(category.id)}
                                                onChange={() => handleCategoryChange(category.id)}
                                                className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <span className="text-sm text-gray-700 dark:text-gray-300">
                                                {category.name}
                                            </span>
                                        </label>
                                    ))}
                                </div>
                            </div>

                            {/* Additional Info */}
                            <div className="space-y-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    📋 Informasi Tambahan
                                </h3>
                                
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fasilitas
                                    </label>
                                    <input
                                        type="text"
                                        value={data.facilities}
                                        onChange={(e) => setData('facilities', e.target.value)}
                                        className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="WiFi, Parkir, Laundry (pisahkan dengan koma)"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Deskripsi Kost
                                    </label>
                                    <textarea
                                        value={data.description}
                                        onChange={(e) => setData('description', e.target.value)}
                                        rows={4}
                                        className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Deskripsi singkat tentang kost..."
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Peraturan Kost
                                    </label>
                                    <textarea
                                        value={data.rules}
                                        onChange={(e) => setData('rules', e.target.value)}
                                        rows={4}
                                        className="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="1. Dilarang membawa teman lawan jenis&#10;2. Jam malam maksimal 22:00&#10;3. Jaga kebersihan bersama"
                                    />
                                </div>
                            </div>

                            {/* Submit Button */}
                            <div className="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={() => window.history.back()}
                                >
                                    ❌ Batal
                                </Button>
                                <Button
                                    type="submit"
                                    disabled={processing}
                                >
                                    {processing ? '⏳ Menyimpan...' : '✅ Simpan Kost'}
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}