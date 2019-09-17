<template>
<div>
     <el-input placeholder="Фамилия" v-model="fio"></el-input>
     <el-input placeholder="Имя" v-model="name"></el-input>
     <el-input placeholder="Отчество" v-model="patronymic"></el-input>
     <el-input placeholder=" +7 (812) 143 - 55 - 47" v-model="tell"></el-input>
     <el-input placeholder="Адрес электронной почты" v-model="adress"></el-input>
     <br>
     <br>
     <br>
     <br>
     <br>
  <p>Организация</p>
  <el-select v-model="value" placeholder="Комитет по информатизации и связи">
    <el-option
      v-for="item in options"
      :key="item.value"
      :label="item.label"
      :value="item.value">
    </el-option>
  </el-select>
     <br>
     <br>
     <br>
     <br>
     <br>
     <p>Должность</p>
     <el-input placeholder="Председатель Комитета" v-model="input"></el-input>
     <br>
     <br>
     <br>
  <el-tabs type="card" @tab-click="handleClick">
  <br>
    <el-tab-pane label="Коллегиальные органы">
    <el-button type="success" @click="kollegial">Добавить коллегиальный орган</el-button>
            <el-table
    :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
    style="width: 100%">
    <br>
    <br>
    <br>
    <br>
    <el-table-column
      label="Наименование коллегиально органа"
      prop="date">
    </el-table-column>
    <el-table-column
      label="Должность"
      prop="name">
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
    </el-tab-pane>
    <el-tab-pane label="Мероприятия">
    <el-button type="success" @click="activity">Добавить мероприятие</el-button>
      <br>
      <br>
    <el-table
    :data="tableData2.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
    style="width: 100%">
    <el-table-column
      label="Дата и время начала мероприятия"
      prop="startData">
    </el-table-column>
    <el-table-column
      label="Дата и время окончания мероприятия"
      prop="endData">
    </el-table-column>
    <el-table-column
      label="Наименование мероприятия"
      prop="nameCompany">
    </el-table-column>
    <el-table-column
      label="Место проведения"
      prop="location">
    </el-table-column>
    <el-table-column
      label="Повестка мероприятия"
      prop="agenda">
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
    </el-tab-pane>
    <el-tab-pane label="Поручения">
    <el-button type="success" @click="orders">Добавить поручения</el-button>  
    <br>
    <br>
  <el-table
    :data="tableData3.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
    style="width: 100%">
    <el-table-column
      label="Номер пункта протокола"
      prop="protokol">
    </el-table-column>
    <el-table-column
      label="Дата пункта протокола"
      prop="dataProtocol">
    </el-table-column>
    <el-table-column
      label="Описание поручения"
      prop="description">
    </el-table-column>
    <el-table-column
      label="Срок исполнения"
      prop="period">
    </el-table-column>
    <el-table-column
      label="Ответственный"
      prop="responsible">
    </el-table-column>
    <el-table-column
      label="Исполнение поручения"
      prop="execution">
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
    </el-tab-pane>
  </el-tabs>
  <br>
  <br>
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
        options: [{
          value: 'Option1',
          label: 'Комитет по информатизации и связи'
        }, {
          value: 'Option2',
          label: 'Option2'
        }],
        value: '',
        activeName: 'first',

        tableData:[{
          date: 'Наименование коллегиально органа 1',
          name: 'Andrey'
        },
        {
          date: 'Наименование коллегиально органа 2',
          name: 'kirill'
        },
        {
          date: 'Наименование коллегиально органа 3',
          name: 'oleg'
        }],

        tableData2: [{
          startData: '2019-05-09',
          endData: '2019-05-10',
          nameCompany: 'naumov',
          location: 'spb',
          agenda: 'Povestka'
        },
        {
          startData: '2019-05-12',
          endData: '2019-05-15',
          nameCompany: 'azmut',
          location: 'spb',
          agenda: 'Повестка в военкомат'
        }],

        tableData3: [{
          protokol: '1.1',
          dataProtocol: '2019-05-10',
          description: 'Описание поручения 1',
          period: '2020-03-12',
          responsible: 'Иванов П.П',
          execution: 'Результат исполнения поручения 1'
        },
        {
          protokol: '2.1',
          dataProtocol: '2019-05-10',
          description: 'Описание поручения 2',
          period: '2020-03-12',
          responsible: 'Иванов П.П',
          execution: 'Результат исполнения поручения 2'
        }],

        search: '',
      }
    },
    
    methods: {
      handleClick(tab, event) {
        console.log(tab,event);
      },

      kollegial: function () {
        this.$router.push({name: 'ocdiCreate'})
      },

      activity: function () {
        this.$router.push({name: 'ocdiActivity'})
      },

      orders: function () {
        this.$router.push({name: 'ocdiOrders'})
      },

      handleEdit(index, row) {
        console.log(index, row);
      },

      handleDelete(index,row) {
        console.log(index, row);
      },

    }
  }
</script>

<style>

.el-input {
    width: 200px
}

p {
    font-size: 15px
}

.el-input .el-input--medium .el-input--suffix {
    width: 400px
}
/*
.el-button {
  position: fixed;
  left: 50px;
}*/

#butt {
  text-align: left;
}
</style>

