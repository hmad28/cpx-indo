import { getStorefrontData } from '@/lib/db';

export const dynamic = 'force-dynamic';

export async function GET() {
    const data = await getStorefrontData();

    return Response.json(data, {
        headers: {
            'Cache-Control': 'public, s-maxage=60, stale-while-revalidate=300',
        },
    });
}
