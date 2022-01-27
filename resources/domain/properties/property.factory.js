import Property from '@/domain/properties/property.model';

export default class PropertyFactory {
  static buildPropertyFromApi({
    id, userId, typeId, name, rentedFrom, rentedTo,
  }) {
    return new Property(id, { id: userId }, { id: typeId }, name, rentedFrom, rentedTo);
  }
}
