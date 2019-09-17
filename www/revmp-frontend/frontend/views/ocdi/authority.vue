<template>
<div>
    <p>Номер пункта протокола</p>
    <el-input placeholder="1.1" v-model="input"></el-input>
    <p>Дата поручения</p>
    <el-date-picker
      v-model="value1"
      type="datetime"
      placeholder="Дата поручения">
    </el-date-picker>
    <br>
    <br>
    <p>Срок исполнения</p>
    <el-date-picker
      v-model="value1"
      type="datetime"
      placeholder="Срок исполнения">
    </el-date-picker>
    <p>Описание поручения</p>
    <el-input placeholder="Наименование 1" v-model="discription"></el-input>
    <p>Исполнение поручения</p>
    <el-input placeholder="Введитет текст" v-model="status"></el-input>
  <br>
  <br>
  <br>
  <br>
  <div id="butt">
        <el-button type="primary" @click="save">Сохранить</el-button>
        <el-button @click="cancel">Отменить</el-button>
  </div>
  <br>
  <br>
</div>
</template>

<script>
  export default {
    data() {
      return {
        pickerOptions: {
          shortcuts: [{
            text: 'Today',
            onClick(picker) {
              picker.$emit('pick', new Date());
            }
          }, {
            text: 'Yesterday',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24);
              picker.$emit('pick', date);
            }
          }, {
            text: 'A week ago',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit('pick', date);
            }
          }]
        },
        value1: '',
        value2: '',
        value3: '',
        input:  ''
      };
    }
  };
</script>

<style>
#butt {
  text-align: left;
}
</style>

