export const dynamic = 'force-dynamic';

export function GET() {
    return Response.json({
        status: 'ok',
        runtime: 'nextjs-serverless',
        database: process.env.DATABASE_URL ? 'neon' : 'demo',
    });
}
