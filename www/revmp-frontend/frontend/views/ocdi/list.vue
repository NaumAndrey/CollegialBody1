<template>
<div>

<el-row>
  <el-button type="primary" circle @click="greet">＋</el-button>
  <el-button type="primary" icon="el-icon-edit" circle></el-button>
  <el-button type="info" circle>⚙</el-button>
  <el-button type="danger"  icon="el-icon-delete" circle></el-button>
</el-row>

  <el-table :data="tableData">
    
    <el-table-column
      label="Тип коллеигального органа"
      prop="type_collegial">
    </el-table-column>

    <el-table-column
      label="Наименование органа"
      prop="name_organ">
    </el-table-column>

    <el-table-column
      label="Правоустанавливающий документ"
      prop="prav_doc">
    </el-table-column>

    <el-table-column
      label="Цель"
      prop="target">
    </el-table-column>

    <el-table-column
      label="Количество мероприятий"
      prop="amount_event">
    </el-table-column>

    <el-table-column
      label="Количество участников"
      prop="amount_members">
    </el-table-column>

    <el-table-column align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Поиск"/>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
        helpers: {
          input: '',
        },

        tableData: [{
          type_collegial: 'Совет',
          name_organ: 'Наименование 1',
          prav_doc: 'name doc 1',
          target: 'target',
          amount_event: '1',
          amount_members: '20',
        },

        {
          type_collegial: 'Комисия',
          name_organ: 'Наименование 2',
          prav_doc: 'name doc 2',
          target: 'target2',
          amount_event: '0',
          amount_members: '15',
        },

        {
          type_collegial: 'Штаб',
          name_organ: 'Наименование 3',
          prav_doc: 'name doc 3',
          target: 'target3',
          amount_event: '2',
          amount_members: '10',
        },
        
        {
          type_collegial: 'Рабочия группа',
          name_organ: 'Наименование 4',
          prav_doc: 'name doc 4',
          target: 'target4',
          amount_event: '4',
          amount_members: '5',
        },],
        search: '',
      }
    },

    /*created () {
      this.getList();
    },*/

    methods: {
      greet: function () {
          this.$router.push({name: 'ocdiCreate'})
      },

      
    },

    /*methods: {
      handleEdit(index, row) {
        console.log(index, row);
      },
      handleDelete(index, row) {
        console.log(index, row);
      }
    },*/
  }

</script>

<style>

.cell .el-button {
    width: 53%
}

.el-row {
    text-align: end;
}

/*.el-input {
  width: 20%
}*/
</style>