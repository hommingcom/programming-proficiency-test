import PropertyType from '@/domain/properties/property-type.model';

export default class PropertyTypeFactory {
  static buildPropertyTypeFromApi({ id, name }) {
    return new PropertyType(id, name);
  }
}
