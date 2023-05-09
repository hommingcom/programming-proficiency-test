export const users = [
  {
    idUser: 1,
    userName: 'Asur Bernardo',
  },
  {
    idUser: 2,
    userName: 'David Gonzalez',
  },
  {
    idUser: 3,
    userName: 'Javier Marti',
  },
];

export const propertyTypes = [
  {
    idProTypes: 1,
    name: 'home',
  },
  {
    idProTypes: 2,
    name: 'garage',
  },
  {
    idProTypes: 3,
    name: 'office',
  },
];
export const properties = [
  {
    id: 1,
    userId: 1,
    typeId: 1,
    nameStreet: 'Penthouse - General Peron 32',
    rentedFrom: new Date(2020, 1, 22),
    rentedTo: new Date(2020, 7, 7),
    rentalDuration: 0,
    currentDate: new Date(),
  },
  {
    id: 2,
    userId: 2,
    typeId: 1,
    nameStreet: 'Flat - Castellana 201',
    rentedFrom: new Date(2023, 1, 1),
    rentedTo: new Date(2023, 7, 1),
    currentDate: new Date(),

  },
  {
    id: 3,
    userId: 1,
    typeId: 2,
    nameStreet: 'Parking - Nuevos Ministerios',
    rentedFrom: new Date(2020, 3, 9),
    rentedTo: new Date(2020, 4, 7),
    currentDate: new Date(),

  },
  {
    id: 7,
    userId: 2,
    typeId: 2,
    nameStreet: 'Parking - Gran Via 56',
    rentedFrom: new Date(2021, 4, 21),
    rentedTo: new Date(2023, 6, 1),
    currentDate: new Date(),

  },
  {
    id: 4,
    userId: 1,
    typeId: 3,
    nameStreet: 'Office - Ibiza Metro',
    rentedFrom: new Date(2020, 5, 22),
    rentedTo: new Date(2023, 5, 30),
    currentDate: new Date(),

  },
  {
    id: 5,
    userId: 1,
    typeId: 3,
    nameStreet: 'Office - Plaza Castilla',
    rentedFrom: new Date(2023, 2, 2),
    rentedTo: new Date(2023, 4, 9),
    currentDate: new Date(),

  },
  {
    id: 6,
    userId: 2,
    typeId: 3,
    nameStreet: 'Office - Puente Segovia',
    rentedFrom: new Date(2021, 2, 2),
    rentedTo: new Date(2022, 3, 3),
    currentDate: new Date(),

  },
];
