import Storefront from '@/components/storefront';
import { getStorefrontData } from '@/lib/db';

export const dynamic = 'force-dynamic';

export default async function HomePage() {
    const data = await getStorefrontData();
    return <Storefront initialData={data} />;
}
