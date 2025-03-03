import { useAxios, type UseAxiosOptions } from '@vueuse/integrations/useAxios'
import type { AxiosRequestConfig } from 'axios'
import axios from 'axios'

const baseURL = import.meta.env.VITE_API_BASE_URL

const instance = axios.create({
  baseURL,
  withCredentials: true,
  withXSRFToken: true,
})

export default (url: string, config: AxiosRequestConfig, options?: UseAxiosOptions) => {
  return useAxios(url, config, instance, options)
}
