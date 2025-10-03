<template lang="">
    <div
        class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 p-8"
    >
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Contacts</h1>
                <p class="text-gray-600">Manage your connections</p>
            </div>
            <button
                @click="handleToggleModal"
                className="flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-3 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl"
            >
                Add Contact
            </button>

            <div class="mb-6 relative">
                <Search
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"
                />
            </div>

            <div v-if="contacts.length > 0">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <div
                        v-for="(contact, index) in contacts"
                        :key="index"
                        class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover:-translate-y-1"
                    >
                        <div
                            class="h-32 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative"
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
                                <h3
                                    class="text-xl font-bold text-gray-800 mb-1"
                                >
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
                                    <span class="text-sm truncate">{{
                                        contact.email
                                    }}</span>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <button
                                    class="w-80 mt-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 shadow-md hover:shadow-lg"
                                    @click="handleEditProfile(contact)"
                                >
                                    View Profile
                                </button>
                                <button
                                    class="w-20 mt-4 bg-gradient-to-r from-red-500 to-error-400 text-white py-3 rounded-lg font-semibold hover:from-red-600 hover:to-error-600 transition-all duration-300 shadow-md hover:shadow-lg"
                                    @click="handleDeleteProfile(contact)"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>No Contact found.</div>

            <div
                v-if="showModal"
                class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50"
            >
                <div
                    class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-screen overflow-y-auto"
                >
                    <div
                        class="sticky top-0 bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 flex justify-between items-center"
                    >
                        <h2 class="text-2xl font-bold">
                            <!-- {editingContact ? 'Edit Contact' : 'Add New Contact'} -->
                        </h2>
                        <button
                            onClick="{closeModal}"
                            class="p-1 hover:bg-white/20 rounded-lg transition-colors"
                        >
                            <X class="w-6 h-6" />
                        </button>
                    </div>

                    <form onSubmit="{handleSubmit}" class="p-6 space-y-4">
                        <div class="flex justify-center">
                            <img
                                v-show="isEditing"
                                :src="'storage/' + form.image"
                                :alt="form.name"
                                class="w-28 h-28 rounded-full border-4 border-white shadow-xl object-cover"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Name *
                            </label>
                            <input
                                type="text"
                                name="name"
                                v-model="form.name"
                                required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-indigo-400 focus:outline-none transition-colors"
                                placeholder="John Doe"
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Email *
                            </label>
                            <input
                                type="email"
                                name="email"
                                v-model="form.email"
                                required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-indigo-400 focus:outline-none transition-colors"
                                placeholder="john@example.com"
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Image URL *
                            </label>
                            <input
                                type="file"
                                name="image"
                                required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-indigo-400 focus:outline-none transition-colors"
                                placeholder="https://example.com/image.jpg"
                                @change="handleFileChange"
                            />
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button
                                type="button"
                                @click="handleCancelClicked"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                v-if="!isEditing"
                                type="button"
                                @click="handleSubmit"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                            >
                                Save
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="handleUpdate(form)"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["contacts"],
    data() {
        return {
            showModal: false,
            form: {
                id: "",
                name: "",
                email: "",
                image: "",
            },
            isEditing: false,
        };
    },
    methods: {
        handleToggleModal() {
            this.showModal = !this.showModal;
        },
        handleFileChange(e) {
            // console.log(e.target.files[0]);
            this.form.image = e.target.files[0];
        },
        handleEditProfile(contact) {
            this.isEditing = true;
            this.form.id = contact.id;
            this.form.name = contact.name;
            this.form.email = contact.email;
            this.form.image = contact.image;
            this.handleToggleModal();
        },
        handleCancelClicked() {
            this.handleToggleModal();
            this.form.id = "";
            this.form.name = "";
            this.form.email = "";
            this.form.image = "";
            this.isEditing = false;
        },
        async handleDeleteProfile(contact) {
            const url = `/api/v1/contacts/${contact.id}`;
            const fd = new FormData();
            fd.append("_method", "DELETE");
            try {
                const response = await axios.post(url, fd);
                if (response.status === 200) this.showModal = false;
                window.location.reload();
            } catch (error) {
                console.log(error);
            }
        },
        async handleSubmit() {
            const url = "/api/v1/contacts";
            const fd = new FormData();
            fd.append("name", this.form.name);
            fd.append("email", this.form.email);
            fd.append("image", this.form.image);
            try {
                const response = await axios.post(url, fd);
                if (response.status === 200) this.handleToggleModal();
                window.location.reload();
            } catch (error) {
                console.log(error);
            }
            // axios
        },
        async handleUpdate(contact) {
            const url = `/api/v1/contacts/${contact.id}`;
            const fd = new FormData();
            fd.append("_method", "PUT");

            fd.append("name", this.form.name);
            fd.append("email", this.form.email);
            fd.append("image", this.form.image);
            // console.log(fd.entries().map((e) => e));
            try {
                const response = await axios.post(url, fd);
                if (response.status === 200) this.showModal = false;
                window.location.reload();
            } catch (error) {
                console.log(error);
            }
            // axios
        },
    },
};
</script>
<style lang=""></style>
