import { mount } from '@vue/test-utils';
import Home from '../../resources/components/Home.vue';

describe('Home.vue', () => {
  test('debe hacer math con el componente', () => {
    const wrapper = mount(Home)
    expect(wrapper.html()).toMatchSnapshot()
  })
})

describe('Probar el filtrado', () => {
  test('Cuando de click se abra el navbar', async () => {

    const wrapper = mount(Home);

    const filterProperty = wrapper.find('#show-filter-property')
    await filterProperty.trigger('click')
    expect(wrapper.emitted().input_click[0]).toBeTruthy();
    expect(wrapper.vm.showTypeProperty).toBeTruthy()
  }),

  test('Debe filtrar por tipo de propiedades', async () =>{
    const wrapper = mount(Home)
    const property = {
      id: 2,
      name: 'garage',
    };

    const dateUsers = [
      { id: 3,
       userId: 1,
       typeId: 2,
       name: 'Parking - Nuevos Ministerios',
       rentedFrom: new Date(2020, 3, 9),
       rentedTo: new Date(2020, 4, 7),
     },
     {
      id: 7,
      userId: 2,
      typeId: 2,
      name: 'Parking - Gran Via 56',
      rentedFrom: new Date(2021, 4, 21),
      rentedTo: null,
    },
    {
      id: 4,
      userId: 1,
      typeId: 3,
      name: 'Office - Ibiza Metro',
      rentedFrom: new Date(2020, 5, 22),
      rentedTo: null,
    },
     ]

    const filterProperty = wrapper.find('#show-filter-property')
    expect(filterProperty.element.id).toBe('show-filter-property')
    await filterProperty.trigger('click')

    expect(wrapper.vm.showTypeProperty).toBeTruthy()
    wrapper.vm.filterByProperties(property)

    expect(wrapper.vm.typeProperty).toBeTruthy()
    expect(wrapper.vm.dateUsers).toStrictEqual( [{
      availible: true,
      id: 3,
      userId: 1,
      typeId: 2,
      name: 'Parking - Nuevos Ministerios',
      printMonth: "Abril 2020 - Mayo 2020",
      rentedFrom: new Date(2020, 3, 9),
      rentedTo: new Date(2020, 4, 7),
    },
    {
      availible: false,
      id: 7,
      userId: 2,
      typeId: 2,
      name: 'Parking - Gran Via 56',
      printMonth: "Mayo 2021",
     rentedFrom: new Date(2021, 4, 21),
     rentedTo: null,
   }])

  })

  test('Debe filtrar por usuarios', () => {

    const wrapper = mount(Home);
    const dateUsers = [];
    const users = [
      {
        id: 1,
        name: 'Asur Bernardo',
      },
      {
        id: 2,
        name: 'David Gonzalez',
      },
      {
        id: 3,
        name: 'Javier Marti',
      },
    ];

    wrapper.vm.filterByUsers(users[1])
    expect(wrapper.vm.typeProperty).toBeTruthy()
    expect(wrapper.vm.titleFilter).toBe('Usuario')
    expect(wrapper.vm.nameFilter).toBe('David Gonzalez')
    expect(wrapper.vm.dateUsers.length).toBe(3)
    expect(wrapper.vm.dateUsers[0].userId).toBe(2)

  })

  test('Debe filtrar por fechas', () => {

    const wrapper = mount(Home);
    const yearAndDay =  {
      start: '2020-04-09',
      end: '2020-02-07'
    }

    wrapper.vm.filterByDate(yearAndDay)
    expect(wrapper.vm.dateUsers.length).toBe(1)
    expect(wrapper.vm.dateUsers[0].id).toBe(3)

  })

})

