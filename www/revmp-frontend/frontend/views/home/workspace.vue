<template>
    <div class="app-container">
<el-popover
    placement="top-start"
    width="600"
    content="">
</el-popover>
          <br>
        <full-calendar :events="events"></full-calendar>
    </div>
</template>

<script>


import { FullCalendar } from 'vue-full-calendar'
import 'fullcalendar/dist/locale/ru'

export default {
components: { FullCalendar },
   data() {

       return {
           events: [
        {
           title: 'Тест',
           start: '2019-04-22',
        }

       ],
           config: {
               locale: 'ru',
           },

          visible: false,
       }
   }
}
</script>

<style>
    @import 'fullcalendar/dist/fullcalendar.css';
</style>