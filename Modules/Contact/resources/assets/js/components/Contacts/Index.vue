<template lang="">
    <div
        class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 p-8"
    >
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Contacts</h1>
                <p class="text-gray-600">Manage your connections</p>
            </div>

            <div class="mb-6 relative">
                <Search
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="(contact, index) in contacts"
                    :key="index"
                    class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover:-translate-y-1"
                >
                    <div
                        className="h-32 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative"
                    ></div>
                    <div class="relative px-6 pb-6">
                        <div class="flex justify-center -mt-16 mb-4">
                            <img
                                :src="'storage/' + contact.image"
                                :alt="contact.name"
                                class="w-28 h-28 rounded-full border-4 border-white shadow-xl object-cover"
                            />
                        </div>

                        <div class="text-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">
                                {{ contact.name }}
                            </h3>
                            <div
                                class="flex items-center justify-center text-gray-600 text-sm mb-2"
                            >
                                <MapPin class="w-4 h-4 mr-1" />
                                {{ contact.location }}
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div
                                class="flex items-center text-gray-700 bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors"
                            >
                                <Mail
                                    class="w-4 h-4 mr-3 text-indigo-500 flex-shrink-0"
                                />
                                <span class="text-sm truncate">{{
                                    contact.email
                                }}</span>
                            </div>
                        </div>

                        <button
                            class="w-full mt-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 shadow-md hover:shadow-lg"
                        >
                            View Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["contacts"],
};
</script>
<style lang=""></style>
