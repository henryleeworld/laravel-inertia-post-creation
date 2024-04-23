<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

const props = defineProps({
    posts: {
        type: Object,
        required: true
    },
    permissions: {
        type: Object,
    }
})

const destroy = (id) => {
    if (confirm(trans('Are you sure?'))) {
        router.delete(route('posts.destroy', id))
    }
}
</script>

<template>
    <head :title="$t('Posts')" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-show="$page.props.flash.message" class="mb-4 rounded-md bg-green-500 px-3 py-2 text-white text-sm font-semibold">
                        {{ $page.props.flash.message }}
                    </div>
                    <Link v-if="permissions.posts_manage" :href="route('posts.create')" class="mb-4 inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                        {{ $t('Add new post') }}
                    </Link>

                    <table class="min-w-full border divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">{{ $t('ID') }}</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">{{ $t('Title') }}</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">{{ $t('Content') }}</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">{{ $t('Created At') }}</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            <tr v-for="post in posts.data">
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ post.id }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ post.title }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ post.content }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ post.created_at }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    <Link v-if="permissions.posts_manage" :href="route('posts.edit', post.id)" class="mr-2 inline-block rounded-md bg-blue-500 px-3 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                                        {{ $t('Edit') }}
                                    </Link>
                                    <button v-if="permissions.posts_manage" @click="destroy(post.id)" type="button" class="rounded-md bg-red-600 px-3 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                                        {{ $t('Delete') }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
