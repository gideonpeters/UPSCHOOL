<template>
    <v-app>
        <submission-view isAdmin/>
    </v-app>
</template>

<script>
import SubmissionView from '@/components/general/course-view/SubmissionView'
export default {
    components: {
        SubmissionView
    }
}
</script>