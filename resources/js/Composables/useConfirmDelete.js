import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'

export function useConfirmDelete() {
    const confirmDelete = (routeName, params = {}) => {
        Swal.fire({
            title: '<span style="font-weight:bold;">Are you sure?</span>',
            html: 'You <b>won’t be able to undo</b> this action!',
            icon: 'warning',
            cancelButtonColor: '#363636',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            customClass: {
                confirmButton: 'bg-white text-red-600 border border-red-600 hover:bg-red-100',
                cancelButton: 'bg-white text-gray-600 border border-gray-600 hover:bg-gray-100',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route(routeName, params), {
                    onError: () => {
                        Swal.fire({
                            title: '❌ Error!',
                            text: 'There was a problem deleting the item.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        })
                    }
                })
            }
        })
    }

    return { confirmDelete }
}
