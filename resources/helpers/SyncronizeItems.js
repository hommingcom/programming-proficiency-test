const SyncronizeItems = ([uArray = [], pType = [], p = []]) => p.map((property) => {
  const user = uArray.find((u) => u.id === property.userId);
  const propertyType = pType.find((type) => type.id === property.typeId);
  return {
    id: property.id,
    user_id: user ? user.id : '',
    user_name: user ? user.name : '',
    prop_name: property.name,
    prop_type: propertyType ? propertyType.name : '',
    rentedFrom: property.rentedFrom,
    rentedTo: property.rentedTo,
    status: property.rentedFrom ? '<span class="text-red-500">Alquilada</span>' : '<span class="text-green-500">Disponible</span>',
  };
});

export default SyncronizeItems;
