<template>
<div>
    <p>Номер пункта протокола</p>
    <el-input placeholder="1.1" v-model="protokol"></el-input>
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
    <br>
    <p>Описание поручения</p>
    <el-input placeholder="Наименование поручения 1" v-model="discription"></el-input>
    <br>
    <p>Исполнение поручения</p>
    <el-input placeholder="Введите текст..." v-model="execution"></el-input>
    <br>
    <br>
    <br>
    <br>
    <h3>Ответсвенные</h3>
    <template>
  <el-table
    :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
    style="width: 100%">
    <el-table-column
      label="ФИО"
      prop="fio">
    </el-table-column>
    <el-table-column
      label="Долженость"
      prop="position">
    </el-table-column>
    <el-table-column
      label="Организация"
      prop="organization">
    </el-table-column>
    <el-table-column
      label="Телефон"
      prop="tell">
    </el-table-column>
    <el-table-column
      label="Адрес электронной почты"
      prop="email">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Type to search"/>
      </template>
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Изменить</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
  <br>
  <br>
  <h3>Рассылка</h3>
    <template>
  <el-table
    :data="tableData2.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
    style="width: 100%">
    <el-table-column
      label="Текст ообщения"
      prop="text">
    </el-table-column>
    <el-table-column
      label="Получатели"
      prop="get">
    </el-table-column>
    <el-table-column
      label="Дата получения"
      prop="dataGet">
    </el-table-column>
    <el-table-column
      label="Периодичность"
      prop="period">
    </el-table-column>
    <el-table-column
      label="Дата и время"
      prop="dataTime">
    </el-table-column>
    <el-table-column
      label="Дкументы карточки"
      prop="doc">
    </el-table-column>
    <el-table-column
      label="Дополнительные документы"
      prop="addDoc">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Type to search"/>
      </template>
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Изменить</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
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
          },

          {
            text: 'Yesterday',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24);
              picker.$emit('pick', date);
            }
          },
          
          {
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

        tableData: [{

          fio: 'test',
          position: 'test',
          organization: 'test1',
          tell: '98798797987',
          email: 'alskdjaslkj@alkwdjl.com'

        }],

        tableData2: [{

          text: 'test',
          get: 'test',
          dataGet: 'test1',
          period: '98798797987',
          dataTime: 'alskdjaslkj@alkwdjl.com',
          doc: 'doc',
          addDoc: 'adddoc'

        }],

        methods: {

          handleEdit(index, row) {
            console.log(index, row);
          },

          handleDelete(index, row) {
            console.log(index, row);
          }
        },


      };
    }
  };
</script>

<style>

  #butt {
    text-align: left;
  }

</style>

