/* eslint-disable */
import * as Router from 'expo-router';

export * from 'expo-router';

declare module 'expo-router' {
  export namespace ExpoRouter {
    export interface __routes<T extends string = string> extends Record<string, unknown> {
      StaticRoutes: `/` | `/(auth)` | `/(auth)/sign-in` | `/(auth)/sign-up` | `/_sitemap` | `/admin` | `/admin/admin_dash` | `/client` | `/client/doctors` | `/client/home` | `/client/logout` | `/client/schedule` | `/doctor` | `/doctor/appointment` | `/doctor/dashboard` | `/doctor/patient` | `/sign-in` | `/sign-up`;
      DynamicRoutes: never;
      DynamicRouteTemplate: never;
    }
  }
}
