<template>
<div>
    <el-input placeholder="Наименование органа" v-model="name"></el-input>
    <template>
        <el-select v-model="value" placeholder="Select">
            <el-option
                    v-for="item in options"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
            </el-option>
        </el-select>
    </template>
    <el-input placeholder="Председатель" v-model="chairman"></el-input>
    <el-input placeholder="Секретарь" v-model="secretary"></el-input>
    <br/>
    <br/>
    <p>Правоустанавливающий документ</p>
    <el-input placeholder="" v-model=title></el-input>
    <p>Дата документа</p>
    <el-date-picker
      v-model="value1"
      type="date"
      placeholder="дд.мм.гггг">
    </el-date-picker>
    <p>Номер документа</p>
    <el-input placeholder="" v-model="numberDoc"></el-input>
    <p>Ссылка на НПА</p>
    <el-input placeholder="" v-model="link"></el-input>
    <br/>
    <br/>
    <el-upload
        class="avatar-uploader"
        action="https://jsonplaceholder.typicode.com/posts/"
        :show-file-list="false"
        :on-success="handleAvatarSuccess"
        :before-upload="beforeAvatarUpload">
        <img v-if="imageUrl" :src="imageUrl" class="avatar">
        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
    </el-upload>
    <p>Цель</p>
    <el-input placeholder="Цель" v-model="target"></el-input>
    <p>Направление деятельности</p>
    <el-input placeholder="Направление деятельности" v-model="direction"></el-input>
    <br/>
    <br/>
    <el-dropdown>
    <template>
      <el-select v-model="iogv" placeholder="Select">
        <el-option
          v-for="item in options"
          :key="item.value"
          :label="item.label"
          :value="item.value">
        </el-option>
      </el-select>
    </template>
</el-dropdown>
<br>
<br>
<template>
  <el-tabs type="card" @tab-click="handleClick">
    <el-tab-pane label="Состав участников">

    <el-button type="sufccess" @click="players">Добавить участника</el-button>

  <template>
  <el-table
    :data="tableData"
    style="width: 100%">
    <el-table-column
      label="Фамилия"
      prop="surname">
    </el-table-column>
    <el-table-column
      label="Имя"
      prop="name">
    </el-table-column>
    <el-table-column
      label="Отчество"
      prop="patranymic">
    </el-table-column>
    <el-table-column
      label="Должность"
      prop="position">
    </el-table-column>
    <el-table-column
      label="Организация"
      prop="organization">
    </el-table-column>
    <el-table-column
      label="Телефон"
      prop="phone">
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
          placeholder="Поиск..."/>
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
    </el-tab-pane>
    <el-tab-pane label="Организации">
      <el-button type="success" @click="organiz">Добавить организацию</el-button>
      <template>
  <el-table
    :data="tableData2"
    style="width: 100%">
    <el-table-column
      label="Полное наименование организации"
      prop="full_name_organization">
    </el-table-column>
    <el-table-column
      label="Сокращенное наименование организации"
      prop="minName">
    </el-table-column>
    <el-table-column
      label="ИНН"
      prop="inn">
    </el-table-column>
    <el-table-column
      label="ОГРН"
      prop="ogrn">
    </el-table-column>
    <el-table-column
      label="Контактный телефон организации"
      prop="phone_organization">
    </el-table-column>
    <el-table-column
      label="Адрес электронной почты организации"
      prop="email_organization">
    </el-table-column>
    <el-table-column
      label="ФИО руководителя"
      prop="fio_leader">
    </el-table-column>
    <el-table-column
      label="Номер телефона руководителя организации"
      prop="phone_leader">
    </el-table-column>
    <el-table-column
      label="Адрес электронной почты руководителя организации"
      prop="email_organization_leader">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Поиск..."/>
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
    </el-tab-pane>
    <el-tab-pane label="Мероприятия">
      <el-button type="success" @click="activity">Добавить мероприятие</el-button>
      <template>
  <el-table
    :data="tableData3"
    style="width: 100%">
    <el-table-column
      label="Наименование мероприятия"
      prop="event_name">
    </el-table-column>
    <el-table-column
      label="Место проведения"
      prop="location">
    </el-table-column>
    <el-table-column
      label="Дата и время начала"
      prop="start_date_and_time">
    </el-table-column>
    <el-table-column
      label="Дата и время окончания"
      prop="end_date_and_time">
    </el-table-column>
    <el-table-column
      label="Повестка мероприятия"
      prop="event_agenda">
    </el-table-column>
    <el-table-column
      label="Председатель мероприятия"
      prop="chairman_event">
    </el-table-column>
    <el-table-column
      label="Секретарь мероприятия"
      prop="event_secretary">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Поиск..."/>
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
    </el-tab-pane>
    <el-tab-pane label="Поручения">
      <el-button type="success" @click="orders">Добавить поручение</el-button>
      <template>
  <el-table
    :data="tableData4"
    style="width: 100%">
    <el-table-column
      label="Номер пункта протокола"
      prop="protokol_item_number_">
    </el-table-column>
    <el-table-column
      label="Дата протокола"
      prop="data_protokol">
    </el-table-column>
    <el-table-column
      label="Описание поручения"
      prop="discription_order">
    </el-table-column>
    <el-table-column
      label="Срок исполнения"
      prop="period_of_execution">
    </el-table-column>
    <el-table-column
      label="Ответственный"
      prop="responsible">
    </el-table-column>
    <el-table-column
      label="Исполнение поручения"
      prop="execution_of_instruction">
    </el-table-column>
    <el-table-column
      label="Файлы"
      prop="file">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Поиск..."/>
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
    </el-tab-pane>
    <el-tab-pane label="Полномочия">
      <el-button type="success" @click="authority">Добавить полномочие</el-button>
  <template>
  <el-table
    :data="tableData5"
    style="width: 100%">
    <el-table-column
      label="Пункт"
      prop="item">
    </el-table-column>
    <el-table-column
      label="Наименование"
      prop="name">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Поиск..."/>
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
    </el-tab-pane>
    <el-tab-pane label="Функции / задачи">
    <el-button type="success" @click="authority">Добавить функцию / задачу</el-button>
    <template>
  <el-table
    :data="tableData6"
    style="width: 100%">
    <el-table-column
      label="Пункт"
      prop="item">
    </el-table-column>
    <el-table-column
      label="Наименование"
      prop="name">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Поиск..."/>
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
    </el-tab-pane>
  </el-tabs>
</template>
<br/>
<br/>
  <br/>
  <br/>
       <div id="butt">
        <el-button type="primary" @click="save">Сохранить</el-button>
        <el-button @click="cancel">Отменить</el-button>
     </div>
     <br/>
     <br/>
</div>
</template>

<script>
import {getList} from '@/api/activity'
export default {
    data() {
      return {
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() > Date.now();
        },

        shortcuts: [
          {
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
          }
          ]
        },

        value1: '',
        value2: '',
        imageUrl: '',

        activeName: 'first',

        tableData: [{
          lustName: 'test',
          name: 'test1',
          papa: 'test2',
          position: 'test3',
          organization: 'test4',
          organization: 'test5',
          phone: '9879879879',
          email: 'dddd@ddd.com'
        }],
        
        tableData2: [{
          fullName: 'test',
          minName: 'test1',
          inn: 'test2',
          ogrn: 'test3',
          phone: 'test4',
          email: 'test5',
          fio: 'tester',
          organizNumber: '6546546546',
          addressEmail: 'test@test.com',
        }],

        tableData3: [{
          nameActiv: 'test',
          location: 'test1',
          dataStart: 'test2',
          endDate: 'test3',
          agenda: 'test4',
          man: 'test5',
          clerk: 'tester'
        }],

        tableData4: [{
          nomerProtokol: 'test',
          dataProtokola: 'test1',
          discription: 'test2',
          term: 'test3',
          responsible: 'test4',
          execution: 'test5',
          file: 'tester'
        }],

        tableData5: [{
          item: 'test',
          name: 'test1'
          
        }],

        tableData6: [{
          item: 'test',
          name: 'test1'
        }],

        options: [{
            value: 'advice',
            label: 'Совет'
        },

        {
          iogv:  'iogv',
          label: 'ИОГВ'
        }],
      };
    },


    created() {
        getList().then(({data}) => this.tableData3 = data)
    },

    methods: {
        handleAvatarSuccess(res, file) {
            this.imageUrl = URL.createObjectURL(file.raw);
        },

        handleClick(tab, event) {
          console.log(tab, event);
        },

        handleEdit(index, row) {
          console.log(index, row);
        },

        handleDelete(index, row) {
          console.log(index, row);
        },

        beforeAvatarUpload(file) {
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;
            
            if (!isJPG) {
                this.$message.error('Avatar picture must be JPG format!');
            }

            if (!isLt2M) {
                this.$message.error('Avatar picture size can not exceed 2MB!');
            }

            return isJPG && isLt2M;
        },

        organiz: function () {
            this.$router.push({name: 'ocdiOrganiz'})
        },

        players: function () {
          this.$router.push({name: 'ocdiPlayers'})
        },

        activity: function () {
          this.$router.push({name: 'ocdiActivity'})
        },
        
        orders: function () {
          this.$router.push({name: 'ocdiOrders'})
        },

        authority: function () {
          this.$router.push({name: 'ocdiAuthority'})
        },
    },
};
</script>

<style>



.el-input {
    width: 20%;
}

.el-dropdown {
    vertical-align: top;
}

.el-dropdown + .el-dropdown {
    margin-left: 15px;
}

.el-icon-arrow-down {
    font-size: 12px;
}

p {
    font-size: 13px;
}

.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409EFF;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}

#butt {
  text-align: left;
}
</style>

